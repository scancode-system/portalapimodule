<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;
use Illuminate\Support\Facades\Storage;

class ValidationService 
{

	public function validations(Event $event)
	{
		$validations = collect([]);

		$event->load('event_validations', 'event_validations.validation');

		$event_validations = $event->event_validations;

		$event_validations = $event_validations->sortByDesc(function($event_validation) { 
			return $event_validation->validation->preference_order;
		});

		foreach ($event_validations as $event_validation) {
			$validations->push([
				'portal_service' => $event_validation->validation->import,
				'data' => 'token/'.$event_validation->validation->alias.'.xlsx'
			]);
		}

		return $validations;
	}

}
