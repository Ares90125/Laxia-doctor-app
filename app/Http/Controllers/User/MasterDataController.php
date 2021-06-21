<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Master\TreatCategoryService;
use App\Services\Master\CategoryService;
use App\Services\Master\ConcernCategoryService;
use App\Services\Master\PrefService;
use App\Services\ClinicService;
use App\Http\Resources\User\Doctor as DoctorResource;
use App\Models\Stuff;

class MasterDataController extends Controller
{

    /**
     * @var TreatCategoryService
     */
    protected $treatCategoryService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var ConcernCategoryService
     */
    protected $concernCategoryService;

    /**
     * @var PrefService
     */
    protected $prefService;

    /**
     * @var ClinicService
     */
    protected $clinicService;

    public function __construct(
        TreatCategoryService $treatCategoryService,
        CategoryService $categoryService,
        ConcernCategoryService $concernCategoryService,
        PrefService $prefService,
        ClinicService $clinicService
    ) {
        $this->treatCategoryService = $treatCategoryService;
        $this->categoryService = $categoryService;
        $this->concernCategoryService = $concernCategoryService;
        $this->prefService = $prefService;
        $this->clinicService = $clinicService;
    }


    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function loadMasterData(Request $request)
    {
        $treatCategories = $this->treatCategoryService->toArray();
        $partCategories = $this->categoryService->toArray();
        $concenrCategories = $this->concernCategoryService->toArray();

        return response()->json([
            'status' => 1,
            'message' => '',
            'data' => [
                'treatCategories' => $treatCategories,
                'partCategories' => $partCategories,
                'concernCategories' => $concenrCategories
            ]
        ], 200);
    }

    public function getAreas()
    {
        return response()->json([
            'status' => 1,
            'data' => $this->prefService->getClinicsAreas(),
        ]);
    }

    public function getRecommend()
    {
        $currentUser = auth()->guard('patient')->user();
        $patient = $currentUser->patient;
        $area_id = $patient->area_id;
        $patient_id = $patient->id;
        
        $clinics = \DB::table('clinics')
            ->select('id', 'name')
            ->where(['pref_id' => $area_id])
            ->get();
        $categories = \DB::table('mtb_part_categories')
            ->select('id', 'name')
            ->whereIn('id', function($subquery) use ($patient_id) {
                $subquery->select('interest_category_id')
                    ->from('patient_interest_categories')
                    ->where('patient_id', $patient_id);
            })
            ->get();
        $follows = $patient->follows;

        $doctors = Stuff::withCount('viewers')
            ->orderby('viewers_count')
            ->paginate(5);

        return response()->json([
            'status' => 1,
            'data' => [
                'clinics' => $clinics,
                'doctors' => DoctorResource::collection($doctors),
                'categories' => $categories,
                'follows' => $follows,
            ]
        ]);
    }
}
