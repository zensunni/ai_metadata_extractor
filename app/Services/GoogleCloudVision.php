<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleCloudVision
{
		protected $key;

		public function __construct($key)
		{
			$this->key = $key;
		}

    public function extract_metadata($url)
    {
			$service_endpoint = "https://vision.googleapis.com/v1/images:annotate?key=$this->key";
			$body = [
				'requests' => [
					'features' => [
						['type' => "FACE_DETECTION"],
						['type' => "LANDMARK_DETECTION"],
						['type' => "LOGO_DETECTION"],
						['type' => "LABEL_DETECTION"],
						['type' => "TEXT_DETECTION"],
						//['type' => "SAFE_SEARCH_DETECTION"],
						//['type' => "IMAGE_PROPERTIES"],
						//['type' => "WEB_DETECTION"],
					],
					'image' => [
						'source' => [
							'imageUri' => $url
						]
					]
				]
			];

			$request = [
				'headers' => ['Accept' => 'application/json'],
				'json' => $body
			];

			$client = new Client();

			$response = $client->request('POST', $service_endpoint, $request);
			$extracted_metadata = json_decode($response->getBody(), true);

			$metadata = $this->map_metadata($extracted_metadata);

			return json_encode($metadata, JSON_PRETTY_PRINT);
    }

    private function map_metadata($extracted_metadata)
    {
      $mapped_metadata = [
        'keywords' => [],
        'logos' => []
      ];

      if(array_key_exists('labelAnnotations', $extracted_metadata['responses'][0])) {
        foreach($extracted_metadata['responses'][0]['labelAnnotations'] as $annotation) {
          if($annotation['score'] > 0.7)
          {
            array_push($mapped_metadata['keywords'], $annotation['description']);
          }
        }
      }

      if(array_key_exists('logoAnnotations', $extracted_metadata['responses'][0])) {
        foreach($extracted_metadata['responses'][0]['logoAnnotations'] as $annotation) {
          if($annotation['score'] > 0.2)
          {
            array_push($mapped_metadata['logos'], $annotation['description']);
          }
        }
      }

      return $mapped_metadata;
    }
}
