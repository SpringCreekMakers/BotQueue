<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\FileRequest;

use App\Http\Requests;
use App\Http\Requests\Upload\UrlRequest;
use App\Models\File\LocalFile;
use FileUtils;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function getIndex()
    {
        return view('upload.index');
    }

    public function postFile(FileRequest $request)
    {
        $uploaded = $request->file('file');

        $file = LocalFile::make($uploaded, $uploaded->getClientOriginalName());

        return redirect()->route('job.create.file', [$file]);
    }

    public function postUrl(UrlRequest $request)
    {
        $url = $request->get('url');

        $name = basename(parse_url($url, PHP_URL_PATH));
        $tmp_file = FileUtils::download($url);

        $file = LocalFile::make($tmp_file, $name, [
            'source_url' => $url
        ]);

        return redirect()->route('job.create.file', [$file]);
    }
}
