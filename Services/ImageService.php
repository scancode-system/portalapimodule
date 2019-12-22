<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;

class ImageService 
{

	public function images(Event $event)
	{
		$images = collect([]);
		
		$images->push([
			'portal_service' => 'Image',
			'data' => null
		]);

		return $images;
	}

}
