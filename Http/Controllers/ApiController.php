<?php

namespace Modules\PortalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PortalApi\Services\SettingService;
use Modules\PortalApi\Services\ImageService;
use Modules\PortalApi\Services\ValidationService;
use Modules\PortalApi\Services\DownloadService;
use Modules\Portal\Entities\Event;

class ApiController extends Controller
{

    public function all(Event $event)
    {
        $response = collect([]);

        $response = $response->merge((new SettingService())->settings($event));
        $response = $response->merge((new ImageService())->images($event));
        $response = $response->merge((new ValidationService())->validations($event));

        return $response;
    }


    public function download(Event $event, DownloadService $download_service)
    {
        $path = $download_service->buildZip($event);
        if($path === false)
        {
            return response()->json([], 204);
        } else {
            return response()->download($path)->deleteFileAfterSend(true);
        }
    }


}
