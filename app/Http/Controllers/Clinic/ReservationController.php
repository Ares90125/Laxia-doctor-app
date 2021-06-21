<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RsvService;
use App\Models\Reservation;
use App\Http\Requests\Clinic\RsvRequest;
use App\Http\Requests\Clinic\RsvPayRequest;
use App\Http\Requests\Clinic\RsvWithUserInfoRequest;

class ReservationController extends Controller
{
    /**
     * @var RsvService
     */
    protected $service;

    public function __construct(
        RsvService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $currentUser = auth()->guard('api')->user();
        $params = $request->all();
        $params['clinic_id'] = $currentUser->clinic->id;
        $reservations = $this->service->paginate($params);
        $count = $this->service->getCountInfo(['clinic_id' => $currentUser->clinic->id]);
        
        return response()->json([
            'reservations' => $reservations,
            'count' => $count
        ], 200);
    }

    public function indexWithPayments(Request $request)
    {
        $currentUser = auth()->guard('api')->user();
        $params = $request->all();
        $params['clinic_id'] = $currentUser->clinic->id;
        $params['confirmed'] = true;
        $reservations = $this->service->paginate($params);

        return response()->json([
            'reservations' => $reservations,
        ], 200);
    }

    public function get($id)
    {
        $rsv = $this->service->get($id);
        $this->authorize('get', $rsv);
        return response()->json([
            'reservation' => $rsv
        ], 200);
    }

    public function store(CaseRequest $request)
    {
        // $currentUser = auth()->guard('api')->user();

        // \DB::beginTransaction();
        // try {
        //     $case = $this->service->store($request->all(), ['clinic_id' => $currentUser->id]);

        //     \DB::commit();
        // } catch (\Throwable $e) {
        //     \DB::rollBack();
        //     \Log::error($e->getMessage());

        //     return response()->json([
        //         'message' => '症例を登録できません。'
        //     ], 500);
        // }
        // return response()->json([
        //     'case' => $case
        // ], 200);
    }

    public function update(RsvRequest $request, $id)
    {
        $rsv = $this->service->get($id);
        $this->authorize('update', $rsv);

        \DB::beginTransaction();
        try {
            $rsv = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '予約情報を変更できません。'
            ], 500);
        }
        return response()->json([
            'reservation' => $rsv
        ], 200);
    }

    public function updateWithUserInfo(RsvWithUserInfoRequest $request, $id)
    {
        $rsv = $this->service->get($id);
        $this->authorize('update', $rsv);

        \DB::beginTransaction();
        try {
            $rsv = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '予約情報を変更できません。'
            ], 500);
        }
        return response()->json([
            'reservation' => $rsv
        ], 200);
    }

    public function pay(RsvPayRequest $request, $id)
    {
        $rsv = $this->service->get($id);
        $this->authorize('update', $rsv);

        \DB::beginTransaction();
        try {
            $rsv = $this->service->updatePayment($request->all(), ['id' => $rsv->id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '予約情報を変更できません。'
            ], 500);
        }
        return response()->json([
            'reservation' => $rsv
        ], 200);

    }

    public function updateStatus($id, $status)
    {
        $rsv = $this->service->updateStatus($id, $status);
        return response()->json([
            'reservation' => $rsv
        ], 200);
    }

    public function uploadPhoto(Request $request)
    {
        // dd($request->file);
        $path = $this->imageUpdateWithThumb('/upload/cases', $request->file, 350);
        return response()->json([
            'photo' => $path
        ], 200);
    }
    
}
