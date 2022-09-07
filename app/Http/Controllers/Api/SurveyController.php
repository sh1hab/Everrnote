<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Models\Survey;
use App\Models\Upload;
use App\Traits\ImageTrait;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class SurveyController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return SurveyResource::collection(Survey::with(['upload'])
            ->where('user_id', $this->user->id)
            ->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSurveyRequest $request
     * @return SurveyResource
     * @throws \Exception
     */
    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();

        if (isset($data['image'])){
            $data['image'] = ImageTrait::saveImage($data['image']);

            $upload = Upload::create([
               'url' => $data['image'],
                'type' => 'image'
            ]);
        }

        $data['upload_id'] = $upload->id;
        $survey = Survey::create($data);

        $survey->load('upload');

        return new SurveyResource($survey);
    }

    /**
     * Display the specified resource.
     *
     * @param Survey $survey
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Survey $survey)
    {
        if ($this->user->id !== $survey->user_id) {
            abort(403, __('global.unauthorised_action'));
        }

        $survey->load(['upload']);

        return $this->sendResponse(new SurveyResource($survey));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSurveyRequest $request
     * @param Survey $survey
     * @return SurveyResource
     * @throws \Exception
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $data = $request->validated();

        if (isset($data['image'])){
            $data['image'] = ImageTrait::saveImage($data['image']);

            if ($survey->image){
                unlink(public_path($survey->image));
            }

            $survey->upload->update([
                'url' => $data['image']
            ]);

        }

        $survey->update($request->validated());

        $survey->load('upload');

        return new SurveyResource($survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Survey $survey
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Survey $survey)
    {
        if ($this->user->id !== $survey->user_id) {
            abort(403, __('global.request'));
        }

        if ($survey->upload){
            $path = public_path().DIRECTORY_SEPARATOR.$survey->upload->url;
            unlink($path);
            $survey->upload()->delete();
        }
        $survey->delete();
        return $this->sendResponse([], false, 204);
    }
}
