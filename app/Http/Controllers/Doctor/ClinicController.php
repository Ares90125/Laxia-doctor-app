<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ClinicService;

class ClinicController extends Controller
{
    /**
     * @var ClinicService
     */
    protected $service;

    public function __construct(
        ClinicService $service
    ) {
        $this->service = $service;
    }

    public function get()
    {
        $doctor_id = auth()->guard('doctor')->user()->id;

        $clinics = $this->service->getAllListByDoctor($doctor_id);
        $options = array();

        foreach($clinics as $clinic) {
            $options[] = array(
                'id' => $clinic->id,
                'text' => $clinic->name,
                'info' => $clinic
            );
        }

        return $options;
    }
}
