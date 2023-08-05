<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show(Request $request,string $path)
    {
        $server= ServerFactory::create([
            'reponse' => new laravelResponseFactory($request),
            'source' => Storage::disk('public')->getDriver(),
            'cache' => Storage::disk('local')->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url'=>'images'
        ]);
        return $server->getImageResponse($path, $request->all());
    }
}
