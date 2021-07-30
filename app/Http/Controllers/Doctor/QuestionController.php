<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Request;
use App\Services\QuestionService;
use App\Services\ViewService;
use App\Services\Doctor\AnswerService;
use App\Models\Question;
use App\Traits\MediaUpload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    use MediaUpload;

    /**
     * @var QuestionService
     */
    protected $service;

    /**
     * @var ViewService
     */
    protected $viewService;

    /**
     * @var AnswerService
     */
    protected $answerService;

    public function __construct(
        QuestionService $service,
        ViewService $viewService,
        AnswerService $answerService
    ) {
        $this->service = $service;
        $this->viewService = $viewService;
        $this->answerService = $answerService;
    }

    /**
     * Search Question
     */
    public function search(Request $request)
    {
        $params = $request->all();
        $questions = $this->service->paginate($params);
        
        return response()->json([
            'status' => 1,
            'data' => [
                'questions' => $questions
            ]
        ], 200);
    }

    /**
     * Get Question Detail
     */
    public function getDetail(Request $request, $id)
    {
        $question = $this->service->get($id);

        return response()->json([
            'status' => 1,
            'data' => [
                'question' => $question->load([
                    'owner',
                    'categories',
                    'medias',
                    'comments_limit50',
                ])
            ]
        ], 200);
    }

    /**
     * Upload Answer Photo
     */
    public function uploadAnswerPhoto(Request $request)
    {
        // $uploadedFile = $request->file('photo');
        // $request->validate([
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $uploadedFile = $request->file;

        $disk = 'public';
        $filename = null;
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $uploadedFile->storeAs('/doctor/answers', $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return response()->json([
            'status' => 1,
            'photo' => 'storage/'.$file,
        ]);
    }

    /**
     * Add Answer
     */
    public function addAnswer(Request $request, $question_id)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;
        $validator = Validator::make($request->all(), [
            'answer' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'エラーが発生しました。',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        \DB::beginTransaction();
        try {
            $answer = $this->answerService->store($request->all(), $question_id, $doctor_id);

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
            'data' => $answer
        ], 200);
    }

    public function deleteAnswer(Request $request, $question_id, $answer_id)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;

        \DB::beginTransaction();
        try {
            $answer = $this->answerService->delete($question_id, $doctor_id, $answer_id);

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
            'data' => $answer
        ], 200);
    }

    public function updateAnswer(Request $request, $question_id, $answer_id)
    {
        $doctor_id = auth()->guard('doctor')->user()->id;
        $validator = Validator::make($request->all(), [
            'answer' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'エラーが発生しました。',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        \DB::beginTransaction();
        try {
            $answer = $this->answerService->update($request->all(), $question_id, $doctor_id, $answer_id);

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
            'data' => $answer
        ], 200);
    }
}
