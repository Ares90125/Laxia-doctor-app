<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    protected $service;

    public function __construct(
        PaymentService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $currentUser = auth()->guard('api')->user();
        $params = $request->all();
        $params['clinic_id'] = $currentUser->clinic->id;
        list($payments, $sum) = $this->service->paginate($params);

        return response()->json([
            'payments' => $payments,
            'sum' => $sum
        ], 200);
    }
}
