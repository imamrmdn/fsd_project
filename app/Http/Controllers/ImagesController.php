<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function view($folder_name, $file_name)
    {
        $storagePath = file_get_contents(public_path('storage/'.$folder_name.'/'.$file_name));
        return response($storagePath)->header('Content-type','image/png');
    }
}
