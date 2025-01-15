<?php

namespace App\Services\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\AuditLog;

class AuditLogService
{
    public function storeAuditLog($user_id,$description)
    {
        $aduditLog = AuditLog::create([
            'user_id' => $user_id,
            'description' => $description,
        ]);

        // return [
        //     'aduditLog' => $aduditLog,
        // ];
    }
}