<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CustomerDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_documents';

    protected $fillable = [
        'uuid',
        'user_id',
        'customer_site_id',
        'doc_type', // Panel Warranty, Inverter Warranty, Installation Agreement, Net-Metering Approval, Invoice, Other
        'title',
        'file_path',
        'valid_until',
        'notes',
    ];

    protected $casts = [
        'valid_until' => 'date',
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'doc_type' => 'required|string',
        'title' => 'required|string|max:255',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function site()
    {
        return $this->belongsTo(CustomerSite::class, 'customer_site_id');
    }
}
