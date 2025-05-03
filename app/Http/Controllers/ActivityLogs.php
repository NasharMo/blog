<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexActivityLogRequest;
use App\Services\ActivityLogService;
use App\Services\ApiResponseService;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogs extends Controller
{
    public function __construct(private ActivityLogService $activityLogService)
    {
        
    }

    public function index(IndexActivityLogRequest $request)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        
        $filters = [
            'action' => $request->input('action'),
            'entity' => $request->input('entity'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
        ];

        $activityLogs = $this->activityLogService->getAll($perPage, $page, $filters);

        return ApiResponseService::create('success', 'Activity logs retrieved successfully', $activityLogs, Response::HTTP_OK);
    }
}
