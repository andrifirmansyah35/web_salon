<?php

namespace App\Http\Controllers;

class StorageController extends Controller
{
    public function file($slug, $file_name)
    {
        $path = storage_path('app/public/' . $slug . '/' . $file_name);
        return response()->file($path);
    }
}
