<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DoctorService;
use App\Services\UserService;
use App\Http\Requests\Doctor\DoctorRequest;
use App\Traits\MediaUpload;

class DoctorController extends Controller
{
    use MediaUpload;

    /**
     * @var DoctorService
     */
    protected $service;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(
        DoctorService $service,
        UserService $userService
    ) {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function get()
    {
        $doctor = auth()->guard('doctor')->user()->doctor;
        return response()->json([
            'doctor' => $doctor->load(['images', 'pref'])
        ]);
    }

    public function idChecker(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $isEnableID = $this->userService->isEnableID($id);
        return response()->json([
            'status' => 1,
            'message' => '',
            'data' => $isEnableID
        ]);
    }

    public function update(DoctorRequest $request, $id)
    {
        $doctor = $this->service->get($id);

        \DB::beginTransaction();
        try {
            $doctor = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'スタッフを変更できません。'
            ], 500);
        }
        return response()->json([
            'doctor' => $doctor->load('images')
        ], 200);
    }

    public function updateFirebaseKey(Request $request)
    {
        \DB::beginTransaction();
        try {
            $attrs = [
                'users' => [
                    'firebase_key' => $request->firebase_key
                ]
            ];

            $user = $this->userService->update($attrs, ['id' => auth()->user()->id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'エラー'
            ], 500);
        }
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function uploadPhoto(Request $request)
    {
        $path = $this->mediaUploadWithThumb('/doctor/doctors', $request->file, 150);
        return response()->json([
            'photo' => $path[1]
        ], 200);
    }

    public function uploadCompanyPhotos(Request $request)
    {
        $path = $this->mediaUploadWithThumb('/doctor/companies', $request->file, 150);
        return response()->json([
            'photo' => $path[1]
        ], 200);
    }

}
