<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;

class CompanyService 
{

	public function settings(Event $event)
	{
		$company = $event->company;
		$company->load(['company_info', 'company_address']);

		return [
				'portal_service' => 'Dashboard@setting',
				'data' => $company 
			];
	}

}
