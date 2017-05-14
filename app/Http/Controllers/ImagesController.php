<?php

namespace App\Http\Controllers;

use Request;

use App\Image;
use App\Services\GoogleCloudVision;

class ImagesController extends Controller
{
    public function index()
    {
      $images = Image::all();

			if (Request::wantsJson())
			{
				return $images;
			}
			else 
			{
      	return view('images/index', compact('images'));
			}
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
			$this->validate(request(), [
				'url' => 'required'
			]);

			$vision = resolve('App\Services\GoogleCloudVision');
			$metadata = $vision->extract_metadata(request('url'));

			Image::create([
				'url' => request('url'),
				'extracted_metadata' => $metadata
			]);
			return redirect('/images');
    }

		public function destroy(Image $image)
		{
			$image->delete();
			return redirect('/images');
		}
}
