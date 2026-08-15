<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Referral extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'referrals';

    protected $fillable = [
        'uuid',
        'referrer_id',
        'referee_name',
        'referee_mobile',
        'referee_city',
        'stage', // Contacted, Site Survey Done, Quotation Shared, Installed, Rejected
        'reward_amount',
        'reward_status', // Pending, Credited, None
        'notes',
        'referral_point_setting_id',
    ];

    protected $casts = [
        'reward_amount' => 'float',
    ];

    public static array $rules = [
        'referee_name' => 'required|string|max:255',
        'referee_mobile' => 'required|string|min:10|max:15',
        'referee_city' => 'nullable|string|max:100',
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
        });
    }

    public function scopeFindWithUuid($query, $uuid, $with = [])
    {
        return $query->where('uuid', $uuid)->with($with)->firstOrFail();
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referralPointSetting()
    {
        return $this->belongsTo(ReferralPointSetting::class, 'referral_point_setting_id');
    }
}
