<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use App\Traits\Tenantable;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admission extends Model implements HasMedia
{
    use HasAdvancedFilter;
    use SoftDeletes;
    use Tenantable;
    use InteractsWithMedia;
    use HasFactory;

    public const MARRIED_RADIO = [
        [
            'label' => 'Yes',
            'value' => '1',
        ],
        [
            'label' => 'No',
            'value' => '2',
        ],
    ];

    public const CODE_DS_GENDER_SELECT = [
        [
            'label' => 'Male',
            'value' => '1',
        ],
        [
            'label' => 'Female',
            'value' => '2',
        ],
    ];

    public $table = 'admissions';

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'checkbox' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'dob',
        'date_time',
        'time',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'code_ds_gender_label',
        'married_label',
        'multiple_file',
        'single_file',
        'multiple_photo',
        'single_photo',
    ];

    protected $orderable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'code_ds_gender',
        'dob',
        'married',
        'height',
        'minimum_income',
        'date_time',
        'email',
        'size',
        'time',
        'belongs_to.name',
        'checkbox',
    ];

    protected $filterable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'code_ds_gender',
        'dob',
        'married',
        'height',
        'minimum_income',
        'date_time',
        'email',
        'size',
        'time',
        'belongs_to.name',
        'belongs_to_many.name',
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'created_at',
        'code_ds_gender',
        'dob',
        'married',
        'height',
        'minimum_income',
        'date_time',
        'email',
        'password',
        'size',
        'time',
        'belongs_to_id',
        'text_area',
        'checkbox',
        'updated_at',
        'deleted_at',
        'owner_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function getCodeDsGenderLabelAttribute()
    {
        return collect(static::CODE_DS_GENDER_SELECT)->firstWhere('value', $this->code_ds_gender)['label'] ?? '';
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMarriedLabelAttribute()
    {
        return collect(static::MARRIED_RADIO)->firstWhere('value', $this->married)['label'] ?? '';
    }

    public function getDateTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setDateTimeAttribute($value)
    {
        $this->attributes['date_time'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function getTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.time_format')) : null;
    }

    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = $value ? Carbon::createFromFormat(config('project.time_format'), $value)->format('H:i:s') : null;
    }

    public function getMultipleFileAttribute()
    {
        return $this->getMedia('admission_multiple_file')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getSingleFileAttribute()
    {
        return $this->getMedia('admission_single_file')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getMultiplePhotoAttribute()
    {
        return $this->getMedia('admission_multiple_photo')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function getSinglePhotoAttribute()
    {
        return $this->getMedia('admission_single_photo')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            $media['thumbnail'] = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function belongsTo()
    {
        return $this->belongsTo(User::class);
    }

    public function belongsToMany()
    {
        return $this->belongsToMany(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
