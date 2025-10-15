<?php

namespace App\Http\Controllers;

use App\Models\ClientDocumentUploaded;
use ConvertApi\ConvertApi;
use DB;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CustomScriptController extends Controller
{
    public function custom_scripts($function_name)
    {
        return $this->$function_name();
    }

    public function generate_thumbnails_for_all_documents()
    {
        ini_set('max_execution_time', 0);
        $all_documents = DB::table('tbl_client_document_uploaded')->where(['is_generated_thumbnails' => 0, 'is_uploaded_to_s3' => 1, 'mime_type' => 'application/pdf'])->get();
        $save_path_dir = public_path()."/documents/for_thumbnail_conversion";
        if (!file_exists($save_path_dir)) {
            $is_file_created = File::makeDirectory($save_path_dir, 0777, true, true);
            echo "is_file_created: ".$is_file_created."\n";
            if (!$is_file_created) {
                echo"Unable to create directory"."\n";
            }
        }
        foreach ($all_documents as $document) {
            $s3_path = $document->document_file;
            if (!empty($s3_path) && Storage::disk('s3')->exists($s3_path)) {
                $contents = Storage::disk('s3')->get($s3_path);
                $save_path = $save_path_dir."/".Str::uuid().".pdf";
                file_put_contents($save_path, $contents);

                ConvertApi::setApiCredentials(env('CONVERTAPI_TOKEN'));
                $pngs = ConvertApi::convert('png', [
                    'File' => $save_path,
                ], 'pdf');
                $final_png_arr = [];
                $newname = basename($s3_path);
                foreach ($pngs->getFiles() as $key => $png) {
                    $s3_path = 'documents/'.$document->client_id.'/'.$newname."_".$key.".png";
                    $url = $png->getUrl();
                    $file_content = file_get_contents($url);
                    if ($file_content) {
                        Storage::disk('s3')->put($s3_path, $file_content);
                    }
                    $final_png_arr[] = $s3_path;
                }
                ClientDocumentUploaded::where('id', $document->id)->update(['thumbnails' => json_encode($final_png_arr), 'is_generated_thumbnails' => 2]);
                sleep(1);
            } else {
                ClientDocumentUploaded::where('id', $document->id)->update(['is_generated_thumbnails' => 3]);
                echo "file not found".$s3_path."\n";
                sleep(1);
            }
        }

        // delete file after processs is completed.
        if (File::exists($save_path_dir)) {
            File::deleteDirectory($save_path_dir);
        }
    }
}
