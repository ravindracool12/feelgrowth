<?php

namespace App\Services;

class UploadMedia {

    public function uploadAvatar($req) {
        $validator = \Validator::make($req->all(), [
            'image' => 'max:2048|mimes:jpeg,png'
        ]);

        if ($validator->fails()) {
            throw new \Exception(\Lang::get('flash.imageUploadError'), 1);
            return;
        }

        $file = $req->file('image');
        $destinationPath = 'upload/avatars/' . date('m') . '/';
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/' . $destinationPath, $filename);
        return $destinationPath . $filename;
    }

    public function uploadProperty($req) {
        $validator = \Validator::make($req->all(), [
            'image' => 'max:2048|mimes:jpeg,png'
        ]);

        if ($validator->fails()) {
            throw new \Exception(\Lang::get('flash.imageUploadError'), 1);
            return;
        }

        $file = $req->file('image');
        $destinationPath = 'upload/properties/' . date('m') . '/';
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/' . $destinationPath, $filename);
        return $destinationPath . $filename;
    }
}
