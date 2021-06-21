<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\MediaService;
use App\Traits\MediaUpload;

class MediaController extends Controller
{
    use MediaUpload;

    /**
     * @var MediaService
     */
    protected $service;

    public function __construct(
        MediaService $service
    ) {
        $this->service = $service;
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'media' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'エラーが発生しました。',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $currentUser = auth()->guard()->user();
        list($path, $thumb_path, $type) = $this->mediaUploadWithThumb('/user/medias', $request->media, 150);

        \DB::beginTransaction();
        try {
            $media = $this->service->store([
                'path' => $path,
                'thumb_path' => $thumb_path,
                'type' => $type,
                'user_id' => $currentUser->id
            ]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return response()->json([
                'message' => 'エラーが発生しました。'
            ], 500);
        }

        return response()->json([
            'media' => $media
        ], 200);
    }    
}
