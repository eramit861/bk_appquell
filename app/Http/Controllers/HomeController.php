<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\App;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use App\Models\AttorneySubscription;
use App\Helpers\VideoHelper;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('calendly_webhook_url', 'about', 'index', 'contact', 'contactus', 'resources', 'about', 'terms_of_services', 'facts', 'privacy', 'video1', 'video2', 'video3', 'video4', 'video5', 'questionnaire', 'county_by_state_name', 'master_credit_search', 'simpletext_message_webhook', 'ai_api_webhook');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['planNames'] = AttorneySubscription::packageNameLandingPageArray();
        $data['planPrices'] = AttorneySubscription::packagePriceArray();

        return view('home', $data);
    }

    public function indexsp()
    {
        App::setLocale('sp');
        $data['planNames'] = AttorneySubscription::packageNameLandingPageArray();
        $data['planPrices'] = AttorneySubscription::packagePriceArray();

        return view('home', $data);
    }

    /**
     * Show the terms of services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function terms_of_services()
    {
        return view('terms-services');
    }

    public function resources()
    {
        return view('resources');
    }

    public function pricing()
    {
        $data['planNames'] = AttorneySubscription::packageNameLandingPageArray();
        $data['planPrices'] = AttorneySubscription::packagePriceArray();

        return view('pricing', $data);
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('aboutus');
    }

    /**
    * Show the faq page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function facts()
    {
        return view('facts');
    }




    /**
    * Show the privacy page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function privacy()
    {
        return view('privacy');
    }


    public function contactus(Request $request)
    {

        if ($request->isMethod('post')) {
            $input = $request->all();
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'comment' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company' => ['required', 'string', 'max:255'],
                    'g-recaptcha-response' => ['required', 'recaptcha'],
                ],
                [
                    'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
                    'g-recaptcha-response.required' => 'Please complete the captcha'
                ]
            );


            if ($validator->fails()) {
                $error = $validator->errors()->first();

                return redirect()->back()->with('error', $error);
            }
            $emails = ['mike@onlinebkquestionnaire.com','info@bkassistant.net','mcroak@bkassistant.net'];
            foreach ($emails as $email) {
                try {
                    Mail::to($email)->send(new ContactUs($input['name'], $input['email'], $input['comment'], $input['phone'], $input['company']));
                } catch (\Exception $e) {

                }

            }

            return redirect()->back()->with('success', 'Message sent.');
        }
    }

    /**
     * Show the video1 page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function video1()
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::VIDEO_LP1_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        return view('video1', ['video' => $video]);
    }

    /**
     * Show the video2 page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function video2()
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::VIDEO_LP2_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        return view('video2', ['video' => $video]);
    }

    /**
     * Show the video3 page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function video3()
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::VIDEO_LP3_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        return view('video3', ['video' => $video]);
    }


    /**
     * Show the video4 page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function video4()
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::VIDEO_LP4_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        return view('video4', ['video' => $video]);
    }

    /**
     * Show the video5 page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function video5()
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::VIDEO_LP5_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        return view('video5', ['video' => $video]);
    }

    public function questionnaire()
    {
        return view('questionnaire');
    }

    public function blog()
    {
        return view('blog');
    }

    public function doc_download($id)
    {
        $docData = \App\Models\ClientDocumentUploaded::where(['id' => $id])->first();
        $docData = !empty($docData) ? $docData->toArray() : [];
        if (empty($docData)) {
            return "";
        }

        $paths = basename($docData['document_file']);
        $fname = explode('.', $paths);
        $updatedName = !empty($docData["updated_name"]) ? rtrim($docData["updated_name"], '.') : $paths;
        $ext = array_pop($fname);
        $filename = $updatedName.'.'.$ext;
        if ($docData["is_uploaded_to_s3"] == 1) {
            if (!Storage::disk('s3')->exists($docData['document_file'])) {
                return "";
            }

            return redirect(Storage::disk('s3')->temporaryUrl(
                $docData['document_file'],
                now()->addDays(2),
                ['ResponseContentDisposition' => 'attachment;filename= '.rawurlencode($filename)]
            ));
        }
    }

}
