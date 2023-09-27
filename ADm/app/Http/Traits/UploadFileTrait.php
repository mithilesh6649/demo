<?php

namespace App\Http\Traits;

trait UploadFileTrait {

    public function uploadMedia($request)
    {
        try {

            switch ($request->document_type) {

                case 'image':
                    $image_parts = explode(";base64,",$request->document);
                    $image_type_aux = explode("image/",$image_parts[0]);
                    $documentMimeType = $image_type_aux[1];

                    $documentName = config('common.report_document_prefix').auth()->id().'-'.now()->timestamp.'.'.$documentMimeType;
                    $file = str_replace('data:image/'.$documentMimeType.';base64,', '', $request->document);
                    $file = str_replace(' ', '+', $file);
                    break;

                case 'pdf':
                    $image_parts = explode(";base64,",$request->document);
                    $image_type_aux = explode("application/",$image_parts[0]);
                    $documentMimeType = $image_type_aux[1];

                    $documentName = config('common.report_document_prefix').auth()->id().'-'.now()->timestamp.'.'.$documentMimeType;
                    $file = str_replace('data:application/'.$documentMimeType.';base64,', '', $request->document);
                    $file = str_replace(' ', '+', $file);
                    break;
            }

            if(uploadFile(base64_decode($file), $documentName, config('common.report_document_disk'))) {

                return \Storage::disk(config('common.report_document_disk'))->url($documentName);
            }

            return false;

        } catch (\Exception $e) {

            \Log::channel('upload_file')->info('Error from medicine reminder', ['error' => $e]);
            return false;
        }
    }
}
