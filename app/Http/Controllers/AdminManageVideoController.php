<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteVideo;
use Exception;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Cache;

class AdminManageVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $webvideos = WebsiteVideo::where("section", "!=", null)->select('section', 'video_type', 'english_video', 'spanish_video', 'webview_english_video', 'webview_spanish_video', 'media_type', 'id', 'iphone_english_video', 'iphone_spanish_video')->orderBy('id', 'desc');
        $media_type = $request->query('media_type') ?? 'website';
        if (!empty($request->query('q'))) {
            $webvideos->Where(function ($query) use ($request) {
                $query->Where('section', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('english_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('spanish_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('webview_english_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('webview_spanish_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('iphone_english_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('iphone_spanish_video', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('media_type', 'like', '%' . $request->query('q') . '%');
            });
        }
        $webvideos->where('media_type', $media_type);

        $webvideos = $webvideos->paginate(100);
        $keyword = $request->query('q') ?? '';

        return view('admin.webvideos.show')->with(['keyword' => $keyword,'selected_media_type' => $media_type,'webvideos' => $webvideos]);
    }


    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $section = $this->checkSection($input);
            $video_type = $request->video_type ?? 1; // Default to URL type

            $this->validate($request, [
                'media_type' => 'required',
                'video_type' => 'required|in:1,2'
            ]);

            // Validate based on video type
            if ($video_type == 1) {
                // URL type - validate URL fields
                $this->validate($request, [
                    'english_video' => 'required|url'
                ]);
            } else {
                // File upload type - validate file fields
                $this->validate($request, [
                    'english_video' => 'required|file|mimes:mp4,avi,mov,wmv,flv,webm|max:102400' // 100MB max
                ]);
            }

            if (WebsiteVideo::where('section', $section)->count() > 0) {
                return redirect()->back()->with('error', " Video Already added for this media type");
            }

            $webvideo = new WebsiteVideo();
            $webvideo->section = $section;
            $webvideo->media_type = $request->media_type;
            $webvideo->video_type = $video_type;

            if ($video_type == 1) {
                // Handle URL type (existing logic)
                $webvideo->english_video = $request->english_video ?? '';
                $webvideo->spanish_video = $request->spanish_video ?? '';
                $webvideo->webview_english_video = $request->webview_english_video ?? '';
                $webvideo->webview_spanish_video = $request->webview_spanish_video ?? '';
                $webvideo->iphone_english_video = $request->iphone_english_video ?? '';
                $webvideo->iphone_spanish_video = $request->iphone_spanish_video ?? '';
            } else {
                // Handle file upload type
                $uploadedFiles = $this->handleVideoUploads($request);
                $webvideo->english_video = $uploadedFiles['english_video'] ?? '';
                $webvideo->spanish_video = $uploadedFiles['spanish_video'] ?? '';
                $webvideo->webview_english_video = $uploadedFiles['webview_english_video'] ?? '';
                $webvideo->webview_spanish_video = $uploadedFiles['webview_spanish_video'] ?? '';
                $webvideo->iphone_english_video = $uploadedFiles['iphone_english_video'] ?? '';
                $webvideo->iphone_spanish_video = $uploadedFiles['iphone_spanish_video'] ?? '';
            }

            Cache::forget('help_document_urls_all');
            Cache::forget('admin_videos');
            Cache::forget('attorney_videos_'.$section);

            if ($webvideo->save()) {
                return redirect()->back()->with('success', 'Record has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    private function checkSection($input)
    {
        return max(is_numeric($input['section_mobile']) ? $input['section_mobile'] : 0, is_numeric($input['section_website']) ? $input['section_website'] : 0, is_numeric($input['section_attorney']) ? $input['section_attorney'] : 0, is_numeric($input['section_misc']) ? $input['section_misc'] : 0, is_numeric($input['section_payroll']) ? $input['section_payroll'] : 0, is_numeric($input['section_videolp']) ? $input['section_videolp'] : 0);
    }

    private function handleVideoUploads(Request $request)
    {
        $uploadedFiles = [];

        // Get section name and section key from the non-null section field
        $sectionName = $this->getSectionName($request);
        $sectionKey = $this->getSectionKey($request);

        $videoFields = [
            'english_video',
            'spanish_video',
            'webview_english_video',
            'webview_spanish_video',
            'iphone_english_video',
            'iphone_spanish_video'
        ];
        // adminvideos/attorney/27/english_video/68dbc41534336.mp4
        foreach ($videoFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Generate unique filename with timestamp and field name
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                $finalFolder = $this->getFinalFolder($field);
                // Create store path: adminvideos/section_name/section_key/final_folder/filename.mp4
                $store_path = "adminvideos/{$sectionName}/{$sectionKey}/{$finalFolder}";


                // Delete previous file from the same $store_path before storing new one
                $existingFiles = \Storage::disk('s3')->files($store_path);
                foreach ($existingFiles as $existingFile) {
                    \Storage::disk('s3')->delete($existingFile);
                }
                // Store file to S3 bucket
                $path = $file->storeAs($store_path, $filename, 's3');

                if ($path) {
                    $uploadedFiles[$field] = $path;
                }
            }
        }

        return $uploadedFiles;
    }

    private function getSectionName(Request $request)
    {
        // Check which section field is not null
        $sectionFields = [
            'section_mobile',
            'section_website',
            'section_attorney',
            'section_misc',
            'section_payroll',
            'section_videolp'
        ];

        foreach ($sectionFields as $field) {
            if ($request->has($field) && !empty($request->input($field))) {
                return str_replace('section_', '', $field); // Return the field name as section name
            }
        }

        return 'default'; // Fallback if no section is found
    }

    private function getSectionKey(Request $request)
    {
        // Check which section field is not null and return its value as section key
        $sectionFields = [
            'section_mobile',
            'section_website',
            'section_attorney',
            'section_misc',
            'section_payroll',
            'section_videolp'
        ];

        foreach ($sectionFields as $field) {
            if ($request->has($field) && !empty($request->input($field))) {
                return $request->input($field); // Return the section value as section key
            }
        }

        return 'default'; // Fallback if no section is found
    }

    private function getFinalFolder($field)
    {
        // Map video fields to their final folder names
        $folderMapping = [
            'english_video' => 'en',
            'spanish_video' => 'sp',
            'webview_english_video' => 'webview_en',
            'webview_spanish_video' => 'webview_sp',
            'iphone_english_video' => 'iphone_en',
            'iphone_spanish_video' => 'iphone_sp'
        ];

        return $folderMapping[$field] ?? $field; // Return mapped folder name or field name as fallback
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $webvideo = WebsiteVideo::where('id', $id)->first();

        return view('modal.admin.manage_videos.edit')->with('webvideo', $webvideo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $section = $this->checkSection($input);
        $video_type = $request->video_type ?? 1; // Default to URL type

        $this->validate($request, [
            'media_type' => 'required',
            'video_type' => 'required|in:1,2'
        ]);

        // Validate based on video type
        if ($video_type == 1) {
            // URL type - validate URL fields
            $this->validate($request, [
                'english_video' => 'required|url'
            ]);
        } else {
            // File upload type - validate file fields
            $this->validate($request, [
                'english_video' => 'required|file|mimes:mp4,avi,mov,wmv,flv,webm|max:102400' // 100MB max
            ]);
        }

        if (WebsiteVideo::where('section', $section)->where('id', '!=', $id)->count() > 0) {
            return redirect()->back()->with('error', " Video Already added for this media type");
        }

        try {
            $updateData = [
                "section" => $section,
                "media_type" => $request->media_type,
                "video_type" => $video_type,
            ];

            if ($video_type == 1) {
                // Handle URL type (existing logic)
                $updateData["english_video"] = $request->english_video ?? '';
                $updateData["spanish_video"] = $request->spanish_video ?? '';
                $updateData["webview_english_video"] = $request->webview_english_video ?? '';
                $updateData["webview_spanish_video"] = $request->webview_spanish_video ?? '';
                $updateData["iphone_english_video"] = $request->iphone_english_video ?? '';
                $updateData["iphone_spanish_video"] = $request->iphone_spanish_video ?? '';
            } else {
                // Handle file upload type
                $uploadedFiles = $this->handleVideoUploads($request);
                $updateData["english_video"] = $uploadedFiles['english_video'] ?? '';
                $updateData["spanish_video"] = $uploadedFiles['spanish_video'] ?? '';
                $updateData["webview_english_video"] = $uploadedFiles['webview_english_video'] ?? '';
                $updateData["webview_spanish_video"] = $uploadedFiles['webview_spanish_video'] ?? '';
                $updateData["iphone_english_video"] = $uploadedFiles['iphone_english_video'] ?? '';
                $updateData["iphone_spanish_video"] = $uploadedFiles['iphone_spanish_video'] ?? '';
            }

            WebsiteVideo::where('id', $id)->update($updateData);

            Cache::forget('help_document_urls_all');
            Cache::forget('admin_videos');
            Cache::forget('attorney_videos_'.$section);

            return redirect()->route('admin_webvideos_index', ['media_type' => $request->media_type])->with('success', 'Record has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with([
                'error' => $e->getMessage(),
                'type' => 'edit'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        WebsiteVideo::where('id', $id)->delete();
        header("Refresh:0");

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
