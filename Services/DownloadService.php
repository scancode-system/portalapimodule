<?php

namespace Modules\PortalApi\Services;

use Modules\Portal\Entities\Event;
use Illuminate\Support\Facades\Storage;
use \ZipArchive;
use Illuminate\Support\Facades\File;  

class DownloadService 
{

	public function buildZip(Event $event)
	{
		$this->moveImageFiles($event);
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

		private function moveImageFiles(Event $event)
	{
		File::copyDirectory(storage_path('app/companies/'.$event->company->id.'/images'), storage_path('app/companies/'.$event->company->id.'/'.$event->id.'/clean/images'));
	}

}
