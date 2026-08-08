<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WalletTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wallet_transactions';

    protected $fillable = [
        'uuid',
        'user_id',
        'type', // Credit, Debit, Payout
        'amount',
        'title',
        'description',
        'reference_type', // Referral, Manual, Payout
        'reference_id',
        'status', // Credited, Pending, Approved, Rejected
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'type' => 'required|in:Credit,Debit,Payout',
        'amount' => 'required|numeric|min:1',
        'title' => 'required|string|max:255',
        'status' => 'required|in:Credited,Pending,Approved,Rejected',
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
}
