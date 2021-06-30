<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PatientInfoService;
use App\Services\RsvService;
use App\Services\PaymentService;
use App\Http\Requests\Clinic\PatientInfoRequest;

class PatientInfoController extends Controller
{
    /**
     * @var PatientInfoService
     */
    protected $service;

    /**
     * @var RsvService
     */
    protected $rsvService;

    /**
     * @var PaymentService
     */
    protected $paymentService;

    public function __construct(
        PatientInfoService $service,
        RsvService $rsvService,
        PaymentService $paymentService
    ) {
        $this->service = $service;
        $this->rsvService = $rsvService;
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['clinic_id'] = auth()->guard('clinic')->user()->clinic->id;
        $patients = $this->service->paginate($params);
        return response()->json([
            'patients' => $patients
        ], 200);
    }

    public function get($id)
    {
        $patientInfo = $this->service->get($id);
        $this->authorize('get', $patientInfo);
        // 
        return response()->json([
            'patientInfo' => $patientInfo,
            // 'hostory' => $history
        ]);
    }

    // public function store(CaseRequest $request)
    // {
    //     $currentUser = auth()->guard('api')->user();

    //     \DB::beginTransaction();
    //     try {
    //         $case = $this->service->store($request->all(), ['clinic_id' => $currentUser->id]);

    //         \DB::commit();
    //     } catch (\Throwable $e) {
    //         \DB::rollBack();
    //         \Log::error($e->getMessage());

    //         return response()->json([
    //             'message' => '症例を登録できません。'
    //         ], 500);
    //     }
    //     return response()->json([
    //         'case' => $case
    //     ], 200);
    // }

    public function update(PatientInfoRequest $request, $id)
    {
        $patientInfo = $this->service->get($id);
        $this->authorize('update', $patientInfo);

        \DB::beginTransaction();
        try {
            $patientInfo = $this->service->update($request->all(), ['id' => $id]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => '患者情報を変更できません。'
            ], 500);
        }
        return response()->json([
            'patientInfo' => $patientInfo
        ], 200);
    }

    public function getPayments($id)
    {
        $patientInfo = $this->service->get($id);
        $this->authorize('update', $patientInfo);

        $params = [
            'clinic_id' => auth()->user()->id,
            'patient_info_id' => $id
        ];

        list($payments, $sum) = $this->paymentService->paginate($params);

        return response()->json([
            'payments' => $payments
        ], 200);
    }
}
