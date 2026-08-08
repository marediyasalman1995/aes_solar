<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ServiceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_requests';

    protected $fillable = [
        'uuid',
        'ticket_no',
        'user_id',
        'customer_site_id',
        'issue_type',
        'preferred_date',
        'description',
        'status', // Pending, Scheduled, In Progress, Resolved, Cancelled
        'admin_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public static array $rules = [
        'issue_type' => 'required|string',
        'preferred_date' => 'nullable|date',
        'description' => 'nullable|string',
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
            if (empty($model->ticket_no)) {
                $model->ticket_no = '#SR-' . rand(2000, 9999);
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

    public function site()
    {
        return $this->belongsTo(CustomerSite::class, 'customer_site_id');
    }
}
