<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Request;
use App\Http\Requests\Clinic\SearchDoctorRequest;
use App\Services\SearchDoctorService;
use App\Http\Requests\Doctor\SearchRequest;
use App\Traits\MediaUpload;
use App\Models\Doctor;

class SearchDoctorController extends Controller
{
    use MediaUpload;

    /**
     * @var SearchDoctorService
     */
    protected $service;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(
        SearchDoctorService $service
    ) {
        $this->service = $service;
    }

    public function search(SearchDoctorRequest $request)
    {
        $doctors = $this->service->search($request->all());
        return response()->json([
            'status' => 1,
            'data' => $doctors
        ]);
    }    
}
