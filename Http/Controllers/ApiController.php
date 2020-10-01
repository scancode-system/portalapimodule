<?php

namespace Modules\PortalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PortalApi\Services\CompanyService;
use Modules\PortalApi\Services\SettingService;
use Modules\PortalApi\Services\ImageService;
use Modules\PortalApi\Services\ValidationService;
use Modules\PortalApi\Services\DownloadService;
use Modules\Portal\Entities\Event;

use Illuminate\Support\Facades\Storage;
use  ZipArchive;

class ApiController extends Controller
{

    public function all(Event $event)
    {
        $response = collect([]);

        $response['company'] = (new CompanyService())->settings($event);
        $response['settings'] = (new SettingService())->settings($event);
        $response['images'] = (new ImageService())->images($event);
        $response['validations'] = (new ValidationService())->validations($event);

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

    public function pos(Request $request, Event $event){
        Storage::putFileAs('companies/'.$event->company->id.'/'.$event->id.'/pos', $request->file('attachment'), 'arquivos');
        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/companies/'.$event->company->id.'/'.$event->id.'/pos/arquivos')) === TRUE) {
            $zip->extractTo(storage_path('app/companies/'.$event->company->id.'/'.$event->id.'/pos/'));
            $zip->close();
        } 
        Storage::delete('companies/'.$event->company->id.'/'.$event->id.'/pos/arquivos');
        date_default_timezone_set('America/Sao_Paulo');
        $event->sync = \Carbon\Carbon::now();
        $event->save();
        return ['sync' => $event->sync];
    }


}
