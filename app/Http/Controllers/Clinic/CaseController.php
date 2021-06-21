<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CaseService;
use App\Http\Requests\CaseRequest;
use App\Traits\MediaUpload;

class CaseController extends Controller
{
    use MediaUpload;

    /**
     * @var CaseService
     */
    protected $service;

    public function __construct(
        CaseService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['clinic_id'] = auth()->guard('clinic')->user()->clinic->id;
        $cases = $this->service->paginate($params);
        return response()->json([
            'cases' => $cases
        ], 200);
    }

    public function store(CaseRequest $request)
    {
        $currentUser = auth()->guard('clinic')->user()->clinic;

        \DB::beginTransaction();
        try {
            $case = $this->service->store($request->all(), ['clinic_id' => $currentUser->id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '症例を登録できません。'
            ], 500);
        }
        return response()->json([
            'case' => $case
        ], 200);
    }

    public function update(CaseRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $case = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '症例を変更できません。'
            ], 500);
        }
        return response()->json([
            'case' => $case
        ], 200);
    }

    public function uploadPhoto(Request $request)
    {
        // dd($request->file);
        $path = $this->mediaUploadWithThumb('/clinic/cases', $request->file, 150);
        return response()->json([
            'photo' => $path[1]
        ], 200);
    }
    
}
