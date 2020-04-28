<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use Illuminate\Support\Facades\Storage;

class DownloadControler extends Controller
{
    public function download(Request $request) {
    	$application = Application::find($request->id);
    	$file_path = $application['file_path'];
        $file_name = $application['file_name'];
        return response()->download(Storage::disk('local')->path($file_path), $file_name); 
    }
}
