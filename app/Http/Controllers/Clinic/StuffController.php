<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StuffService;
use App\Http\Requests\StuffRequest;
use App\Models\Stuff;
use App\Traits\MediaUpload;

class StuffController extends Controller
{
    use MediaUpload;

    /**
     * @var StuffService
     */
    protected $service;

    public function __construct(
        StuffService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['clinic_id'] = auth()->guard('clinic')->user()->clinic->id;
        $stuffs = $this->service->paginate($params);
        return response()->json([
            'stuffs' => $stuffs
        ], 200);
    }

    // public function getAll(Request $request)
    // {
    //     $params = $request->all();
    //     $params['clinic_id'] = auth()->guard('clinic')->user()->clinic->id;
    //     $stuffs = $this->service->getList($params);
    //     return response()->json([
    //         'stuffs' => $stuffs
    //     ], 200);
    // }

    public function store(StuffRequest $request)
    {
        $currentUser = auth()->guard('clinic')->user()->clinic;

        \DB::beginTransaction();
        try {
            $stuff = $this->service->store($request->all(), ['clinic_id' => $currentUser->id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'スタッフを登録できません。'
            ], 500);
        }
        return response()->json([
            'stuff' => $stuff
        ], 200);
    }

    public function update(StuffRequest $request, $id)
    {
        $params = $request->stuffs;
        $stuff = $this->service->get($id);
        $currentUser = auth()->guard('clinic')->user()->clinic;
        if ($currentUser->id != $stuff->clinic_id) {
            return response()->json([
                'message' => '権限がありません。'
            ], 403);
        }

        \DB::beginTransaction();
        try {
            $stuff = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'スタッフを変更できません。'
            ], 500);
        }
        return response()->json([
            'stuff' => $stuff
        ], 200);
    }

    public function uploadPhoto(Request $request)
    {
        $path = $this->mediaUploadWithThumb('/clinic/stuffs', $request->file, 150);
        return response()->json([
            'photo' => $path[1]
        ], 200);
    }
    
}
