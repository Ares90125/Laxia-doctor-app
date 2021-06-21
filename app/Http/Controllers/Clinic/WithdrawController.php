<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WithdrawService;
use App\Models\Withdraw;

class WithdrawController extends Controller
{
    /**
     * @var WithdrawService
     */
    protected $service;

    public function __construct(
        WithdrawService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $currentUser = auth()->guard('api')->user();
        $params = $request->all();
        $params['clinic_id'] = $currentUser->clinic->id;
        $params['is_paid'] = true;

        $withdraws = $this->service->paginate($params);

        return response()->json([
            'withdraws' => $withdraws,
        ], 200);
    }

    public function get($ym)
    {
        $currentUser = auth()->guard('api')->user();
        $where = [
            'clinic_id' => $currentUser->clinic->id,
            'month' => $ym
        ];

        $withdraw = $this->service->getWhere($where);

        return response()->json([
            'withdraw' => $withdraw,
        ], 200);
    }
}
