<?php

namespace Modules\PortalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PortalApi\Services\SettingService;

class SettingController extends Controller
{

    public function index(Event $event, SettingService $setting_service)
    {
        return $setting_service->allSettings($event);
    }


}
