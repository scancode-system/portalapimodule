<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;
use Illuminate\Support\Facades\Storage;
use \ZipArchive;

class DownloadService 
{

	public function buildZip(Event $event)
	{
		$files = Storage::allFiles('companies/'.$event->company_id.'/'.$event->id.'/clean');
		if(count($files)){
			$zip_path = storage_path('app/companies/'.$event->company_id.'/'.$event->id.'/clean'.'.zip'); 

			$zip = new ZipArchive;
			$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach ($files as $file) {
				$file = str_replace('companies/'.$event->company_id.'/'.$event->id.'/clean'.'/', '', $file);
				$zip->addFile(storage_path('/app/companies/'.$event->company_id.'/'.$event->id.'/clean'.'/'.$file), $file);
			}

			$zip->close();
			return $zip_path; //response()->download($zip_path)->deleteFileAfterSend(true);
		} else {
			return false; // response()->json([], 204);
		}
	}

}
