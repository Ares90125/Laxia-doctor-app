<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Request;
use App\Http\Requests\Doctor\DoctorCaseRequest;
use App\Services\Doctor\DoctorCaseService;
use App\Models\Question;
use App\Traits\MediaUpload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DoctorCaseController extends Controller
{
    use MediaUpload;

    /**
     * @var DoctorCaseService
     */
    protected $service;


    public function __construct(
        DoctorCaseService $service
    ) {
        $this->service = $service;
    }

    /**
     * Upload Photo
     */
    public function uploadPhoto(Request $request)
    {
        $uploadedFile = $request->file;
//        $request->validate([
//            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);

        $disk = 'public';
        $filename = null;
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $uploadedFile->storeAs('/doctor/cases', $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return response()->json([
            'status' => 1,
            'photo' => 'storage/'.$file,
        ]);
    }

    public function uploadBeforePhoto(Request $request) {
        $uploadedFile = $request->file;

        $disk = 'public';
        $filename = null;
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $uploadedFile->storeAs('/doctor/cases/before', $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

       return response()->json([
           'status' => 1,
           'photo' => 'storage/'. $file,
       ]);
    }

    public function uploadAfterPhoto(Request $request)
    {    
        $uploadedFile = $request->file;
        $disk = 'public';
        $filename = null;
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $uploadedFile->storeAs('/doctor/cases/after', $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

       return response()->json([
           'status' => 1,
           'photo' => 'storage/'.$file,
       ]);
    }

    /**
     * Add Answer
     */
    public function store(DoctorCaseRequest $request)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;

        \DB::beginTransaction();
        try {
            $case = $this->service->store($request->all(), $doctor_id);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'エラーが発生しました。'
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'data' => $case
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;

        \DB::beginTransaction();
        try {
            $case = $this->service->delete($doctor_id, $id);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'エラーが発生しました。'
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'data' => $case
        ], 200);
    }

    public function get(Request $request)
    {
        $params = $request->all();
        $params['doctor_id'] = auth()->guard('doctor')->user()->id;
        
        $cases = $this->service->paginate($params);

        return response()->json([
                'cases' => $cases
        ], 200);
    }

    public function getDoctorCases(Request $request, $id)
    {
        $case = $this->service->get($id);

        return response()->json([
            'status' => 1,
            'data' => $case
        ], 200);
    }


    public function getDetail(Request $request, $id)
    {
        $case = $this->service->getDetail($id);

        return response()->json([
            'status' => 1,
            'data' => $case
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;

        \DB::beginTransaction();
        try {
            $case = $this->service->update($request->all(), $doctor_id, $id);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'エラーが発生しました。'
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'data' => $case
        ], 200);
    }
}
