<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;

class ImageService 
{

	public function images(Event $event)
	{
		$images = collect([]);
		
		$images->push([
			'portal_service' => 'Product@images',
			'data' => 'token/images/produtos/'
		]);

		$images->push([
			'portal_service' => 'Dashboard@logo',
			'data' => 'token/images/logo/logo.png'
		]);

		return $images;
	}

}
