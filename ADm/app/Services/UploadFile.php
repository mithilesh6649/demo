<?php

namespace App\Services;
use Storage;

class UploadFile
{
    protected const USER_PROFILE_IMAGE_DISK = 'profile';

    public function uploadProfileImage($file)
    {
        $imageName = config('common.profileImagePrefix').auth()->id().'.png';

        $image = str_replace('data:image/png;base64,', '', $file);
        $image = str_replace(' ', '+', $image);

        if(UploadFile::uploadFile(base64_decode($image), $imageName, UploadFile::USER_PROFILE_IMAGE_DISK)) {

            return $imageName;
        } else {

            return false;
        }
    }

    private function uploadFile($file, $imageName, $disk)
    {
        try {
            Storage::disk($disk)->put($imageName, $file);

            return true;

        } catch (\Exception $e) {

            dd($e);
            return false;
        }
    }
}
