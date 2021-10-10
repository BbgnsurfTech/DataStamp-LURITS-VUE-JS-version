<?php

namespace App\Http\Requests;

use App\Models\Admission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateAdmissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('admission_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'max:50',
                'required',
            ],
            'middle_name' => [
                'string',
                'max:50',
                'nullable',
            ],
            'last_name' => [
                'string',
                'max:50',
                'required',
            ],
            'code_ds_gender' => [
                'required',
                'in:' . implode(',', Arr::pluck(Admission::CODE_DS_GENDER_SELECT, 'value')),
            ],
            'dob' => [
                'date_format:' . config('project.date_format'),
                'nullable',
            ],
            'married' => [
                'required',
                'in:' . implode(',', Arr::pluck(Admission::MARRIED_RADIO, 'value')),
            ],
            'height' => [
                'numeric',
                'nullable',
            ],
            'minimum_income' => [
                'numeric',
                'nullable',
            ],
            'date_time' => [
                'date_format:' . config('project.datetime_format'),
                'nullable',
            ],
            'email' => [
                'nullable',
            ],
            'password' => [
                'nullable',
            ],
            'size' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'time' => [
                'date_format:' . config('project.time_format'),
                'nullable',
            ],
            'multiple_file' => [
                'array',
                'nullable',
            ],
            'multiple_file.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'single_file' => [
                'array',
                'nullable',
            ],
            'single_file.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'multiple_photo' => [
                'array',
                'nullable',
            ],
            'multiple_photo.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'single_photo' => [
                'array',
                'nullable',
            ],
            'single_photo.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'belongs_to_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'belongs_to_many' => [
                'array',
            ],
            'belongs_to_many.*.id' => [
                'integer',
                'exists:users,id',
            ],
            'text_area' => [
                'string',
                'nullable',
            ],
            'checkbox' => [
                'boolean',
            ],
        ];
    }
}
