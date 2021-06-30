<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\StuffService;
use App\Services\ViewService;
use App\Http\Requests\StuffRequest;
use App\Models\Stuff;

class StuffController extends Controller
{
    /**
     * @var StuffService
     */
    protected $service;

    /**
     * @var ViewService
     */
    protected $viewService;

    public function __construct(
        StuffService $service,
        ViewService $viewService
    ) {
        $this->service = $service;
        $this->viewService = $viewService;
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $stuffs = $this->service->paginate($params);
        return response()->json([
            'stuffs' => $stuffs
        ], 200);
    }
    
    public function get(Stuff $stuff)
    {
        $patient = auth()->guard('patient')->user()->patient;
        $this->viewService->view($patient, $stuff);
        return response()->json([
            'stuff' => $stuff->load([
                'specialities'
            ])
        ], 200);
    }

    public function toggleLike(Stuff $stuff)
    {
        $patient = auth()->guard('patient')->user()->patient;
        if (!isset($patient)) {
            return response()->json([
                'status' => 0,
                'message' => 'いいねすることができません',
            ], 200);
        }
        $result = $stuff->likers()->toggle($patient->id);
        return response()->json([
            'status' => 1,
            'data' => $result
        ], 200);
    }

    public function toggleFavorite(Stuff $stuff)
    {
        $patient = auth()->guard('patient')->user()->patient;
        $result = $stuff->favoriters()->toggle($patient->id);
        return response()->json([
            'status' => 1,
            'data' => $result
        ], 200);
    }
    
}
