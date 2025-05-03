<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    public function getAll($perPage = 10, $page = 1, $filters = [])
    {
        $query = ActivityLog::query();

        if (!empty($filters['action'])) {
            $query->where('action_type', 'LIKE', '%' . $filters['action'] . '%');
        }

        if (!empty($filters['entity'])) {
            $query->where('entity_type', 'LIKE', '%' . $filters['entity'] . '%');
        }

        if (!empty($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}