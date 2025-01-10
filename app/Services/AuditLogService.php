<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AuditLogService
{
    protected $auditLogModel;

    public function __construct(AuditLog $auditLogModel)
    {
        $this->auditLogModel = $auditLogModel;
    }

    public function createAuditLog($data)
    {
        $auditLog = AuditLog::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
            // 'email' => $data['email'],
        ]);

        return [
            'auditLog' => $auditLog,
        ];
    }

    public function showAuditLog($id)
    {
        return AuditLog::where('user_id',$id)->get();
    }

    public function listAuditLogs($perPage = 10, $page = 1)
    {
        return AuditLog::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateAuditLog($data, $id)
    {
        $auditLog = AuditLog::find($id);

        if (!$auditLog) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $auditLog->co = $data['co'];
        }

        $auditLog->save();

        return $auditLog;
    }

    public function deleteAuditLog($id)
    {
        $auditLog = AuditLog::find($id);
        if (!$auditLog) {
            return null;
        }

        $auditLog->delete();

        return $auditLog;
    }
}
