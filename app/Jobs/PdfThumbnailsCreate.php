<?php

namespace App\Jobs;

use App\Models\ClientDocumentUploaded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ConvertApi\ConvertApi;
use Storage;
use Illuminate\Support\Str;

class PdfThumbnailsCreate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $document_id;
    protected $client_id;
    public function __construct($params)
    {
        //
        $this->document_id = $params['document_id'];
        $this->client_id = $params['client_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            $document = ClientDocumentUploaded::where('id', $this->document_id)->first();
            ClientDocumentUploaded::where('id', $this->document_id)->update(['is_generated_thumbnails' => 1]);
            $pdf_document = $document->document_file;
            $newname = basename($pdf_document, ".pdf");
            ConvertApi::setApiCredentials(env('CONVERTAPI_TOKEN'));
            $pngs = ConvertApi::convert('png', [
                'File' => public_path().'/documents/'.$this->client_id.'/imgtopdfconverted/'.$newname.'.pdf',
            ], 'pdf');
            $final_png_arr = [];
            foreach ($pngs->getFiles() as $key => $png) {
                $extension = pathinfo($newname, PATHINFO_EXTENSION); // Get file extension
                $uniqueName = Str::uuid() . '.' . $extension; // Generates something like "f47ac10b-58cc-4372-a567-0e02b2c3d479.jpg"
                $s3_path = 'documents/' . $this->client_id . '/' . $uniqueName;

                //$s3_path = 'documents/'.$this->client_id.'/'.$newname."_".$key.".png";
                $url = $png->getUrl();
                $file_content = file_get_contents($url);
                if ($file_content) {
                    Storage::disk('s3')->put($s3_path, $file_content);
                }
                $final_png_arr[] = $s3_path;
            }

            ClientDocumentUploaded::where('id', $this->document_id)->update(['thumbnails' => json_encode($final_png_arr), 'is_generated_thumbnails' => 2]);
            ClientDocumentUploaded::clearTempDirs($this->client_id);
        } catch (\Exception $e) {
            ClientDocumentUploaded::clearTempDirs($this->client_id);
            ClientDocumentUploaded::where('id', $this->document_id)->update(['is_generated_thumbnails' => 3]);
        }
    }
}
