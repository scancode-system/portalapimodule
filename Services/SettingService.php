<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;

class SettingService 
{

	public function settings(Event $event)
	{
		$settings = collect([]);

		$event->load('event_settings', 'event_settings.configurable', 'event_settings.setting');
		
		$event_settings = $event->event_settings;
		foreach ($event_settings as $event_setting) {
			$settings->push([
				'portal_service' => $event_setting->setting->module,
				'data' => $event_setting->configurable 
			]);
		}

		return $settings;
	}

}
