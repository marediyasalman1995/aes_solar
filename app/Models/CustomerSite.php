<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CustomerSite extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_sites';

    protected $fillable = [
        'uuid',
        'user_id',
        'site_name',
        'site_code',
        'capacity_kw',
        'system_type',
        'installation_date',
        'inverter_details',
        'panel_details',
        'monthly_avg_kwh',
        'co2_offset_ton',
        'address',
        'city',
        'state',
        'pincode',
        'consumer_number',
        'discom_name',
        'status',
    ];

    protected $casts = [
        'capacity_kw' => 'float',
        'monthly_avg_kwh' => 'float',
        'co2_offset_ton' => 'float',
        'installation_date' => 'date',
        'status' => 'integer',
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'site_name' => 'required|string|max:255',
        'capacity_kw' => 'required|numeric|min:0.1',
        'system_type' => 'required|string',
        'city' => 'nullable|string',
        'address' => 'nullable|string',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
            if (empty($model->site_code)) {
                $model->site_code = 'AES-S-' . rand(1000, 9999);
            }
        });

        self::saving(function ($model) {
            if ($model->capacity_kw) {
                $model->monthly_avg_kwh = $model->capacity_kw * 120.00;
                $model->co2_offset_ton = $model->capacity_kw * 0.40;
            }
        });
    }

    public function scopeFindWithUuid($query, $uuid, $with = [])
    {
        return $query->where('uuid', $uuid)->with($with)->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'customer_site_id');
    }

    public function documents()
    {
        return $this->hasMany(CustomerDocument::class, 'customer_site_id');
    }
}
