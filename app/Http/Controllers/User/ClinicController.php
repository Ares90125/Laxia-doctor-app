<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Clinic\ClinicRequest;
use App\Services\ClinicService;
use App\Services\UserService;
use App\Models\Clinic;

class ClinicController extends Controller
{
    /**
     * @var ClinicService
     */
    protected $service;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(
        ClinicService $service,
        UserService $userService
    ) {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function search(Request $request)
    {
        $clinics = $this->service->paginate($request->all());
        return response()->json([
            'clinics' => $clinics
        ]);
    }

    public function get($id)
    {
        $clinic = $this->service->get($id);
        return response()->json([
            'clinic' => $clinic
        ]);
    }

    public function toggleFavorite(Clinic $clinic)
    {
        $patient = auth()->guard('patient')->user()->patient;
        $result = $clinic->favoriters()->toggle($patient->id);
        return response()->json([
            'status' => 1,
            'data' => $result
        ], 200);
    }
    
}
