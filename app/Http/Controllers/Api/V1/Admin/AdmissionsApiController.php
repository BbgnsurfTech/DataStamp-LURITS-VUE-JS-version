<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmissionRequest;
use App\Http\Requests\UpdateAdmissionRequest;
use App\Http\Resources\Admin\AdmissionResource;
use App\Models\Admission;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdmissionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdmissionResource(Admission::with(['belongsTo', 'belongsToMany'])->advancedFilter());
    }

    public function store(StoreAdmissionRequest $request)
    {
        $admission = Admission::create($request->validated());
        $admission->belongsToMany()->sync($request->input('belongs_to_many.*.id', []));
        if ($media = $request->input('multiple_file', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $admission->id]);
        }

        if ($media = $request->input('single_file', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $admission->id]);
        }

        if ($media = $request->input('multiple_photo', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $admission->id]);
        }

        if ($media = $request->input('single_photo', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $admission->id]);
        }

        return (new AdmissionResource($admission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('admission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'belongs_to'      => User::get(['id', 'name']),
                'belongs_to_many' => User::get(['id', 'name']),
                'married'         => Admission::MARRIED_RADIO,
                'code_ds_gender'  => Admission::CODE_DS_GENDER_SELECT,
            ],
        ]);
    }

    public function show(Admission $admission)
    {
        abort_if(Gate::denies('admission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdmissionResource($admission->load(['belongsTo', 'belongsToMany']));
    }

    public function update(UpdateAdmissionRequest $request, Admission $admission)
    {
        $admission->update($request->validated());
        $admission->belongsToMany()->sync($request->input('belongs_to_many.*.id', []));
        $admission->updateMedia($request->input('multiple_file', []), 'admission_multiple_file');
        $admission->updateMedia($request->input('single_file', []), 'admission_single_file');
        $admission->updateMedia($request->input('multiple_photo', []), 'admission_multiple_photo');
        $admission->updateMedia($request->input('single_photo', []), 'admission_single_photo');

        return (new AdmissionResource($admission))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Admission $admission)
    {
        abort_if(Gate::denies('admission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new AdmissionResource($admission->load(['belongsTo', 'belongsToMany'])),
            'meta' => [
                'belongs_to'      => User::get(['id', 'name']),
                'belongs_to_many' => User::get(['id', 'name']),
                'married'         => Admission::MARRIED_RADIO,
                'code_ds_gender'  => Admission::CODE_DS_GENDER_SELECT,
            ],
        ]);
    }

    public function destroy(Admission $admission)
    {
        abort_if(Gate::denies('admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admission->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['admission_create', 'admission_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model         = new Admission();
        $model->id     = $request->input('model_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));

        return response()->json($media, Response::HTTP_CREATED);
    }
}
