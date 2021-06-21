<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Services\Clinic\ClinicDoctorsRelationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClinicDoctorsRelationController extends Controller
{
    /**
     * @var ClinicDoctorsRelationService
     */
    protected $service;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(
        ClinicDoctorsRelationService $service,
        UserService $userService
    ) {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function get()
    {
        $user_id = auth()->guard('clinic')->user()->id;
        $doctors = $this->service->get($user_id);
        return response()->json([
            'status' => 1,
            'data' => $doctors
        ], 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'doctor_id' => 'required|integer|exists:doctors,doctor_id',
        ]);
    }

    public function add(Request $request)
    {
        $user_id = auth()->guard('clinic')->user()->id;
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'エラーが発生しました。',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $data = $request->all();
        
        \DB::beginTransaction();
        try {
            $clinicDoctorRelation = $this->service->add($user_id, $data['doctor_id']);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'status' => 0,
                'message' => 'ドクターを追加できません。'
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'id' => $clinicDoctorRelation
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $user_id = auth()->guard('clinic')->user()->id;

        \DB::beginTransaction();
        try {
            $clinicDoctorRelation = $this->service->delete($user_id, $id);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'status' => 0,
                'message' => 'ドクターを削除できません。'
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'id' => $clinicDoctorRelation
        ], 200);
    }
}
