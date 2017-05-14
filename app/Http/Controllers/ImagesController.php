<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;


class ImagesController extends Controller
{
    public function index()
    {
      $images = Image::all();
      return view('images/index', compact('images'));
    }

    public function show(Image $image)
    {
      return view('images/show', compact('image'));
    }

    public function create()
    {
      return view('images/create');
    }

    public function store()
    {
			Image::create([
				'url' => request('url')
			]);
			//$post = new Image;
			//$post->url = request('url');
			//$post->save();
			return redirect('/images');
    }
}
