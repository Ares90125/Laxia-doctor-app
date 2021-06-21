<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PointService;
use App\Http\Resources\User\PointHistory as PointHistoryResource;

class PointController extends Controller
{
    /**
     * @var PointService
     */
    protected $service;

    public function __construct(
        PointService $service
    ) {
        $this->service = $service;
    }

    public function getHistory()
    {
        $patient = auth()->guard('patient')->user()->patient;
        $histories = $this->service->paginate(['patient_id' => $patient->id]);

        return PointHistoryResource::collection($histories);
    }
}
