<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class imageController extends Controller
{
    public function index($filename){
        $path = 'images/product/' . $filename; // Шлях до зображення
        if (Storage::disk('public')->exists($path)) {
            $file = Storage::disk('public')->get($path);
            return new Response($file, 200);
        } else {
            abort(404);
        }

    }
}
