<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, SoftDeletes;


    public $fillable = [
        'id',
        'address',
        'mobile',
        'mobile_2',
        'mobile_3',
        'whatsapp',
        'email',
        'email_2',
        'facebook',
        'twitter',
        'linkdin',
        'youtube',
        'instagram',
        'telegram',
        'flickr',
        'footer_text',
        'pay_store_url',
        'app_store_url',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'mail_status',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'address' => 'string',
        'flickr' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keyword' => 'string',
        'telegram' => 'string',
        'instagram' => 'string',
        'youtube' => 'string',
        'linkdin' => 'string',
        'twitter' => 'string',
        'facebook' => 'string',
        'map' => 'string',
        'email_2' => 'string',
        'email' => 'string',
        'mobile_3' => 'string',
        'mobile_2' => 'string',
        'mobile' => 'string',
        'whatsapp' => 'string',
        'app_store_url' => 'string',
        'pay_store_url' => 'string',
        'mail_status' => 'integer',
        'mail_mailer' => 'string',
        'mail_host' => 'string',
        'mail_port' => 'string',
        'mail_username' => 'string',
        'mail_password' => 'string',
        'mail_encryption' => 'string',
        'mail_from_address' => 'string',
        'mail_from_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'address' => 'nullable',
        'flickr' => 'nullable',
        'meta_title' => 'nullable',
        'meta_description' => 'nullable',
        'meta_keyword' => 'nullable',
        'telegram' => 'nullable',
        'instagram' => 'nullable',
        'youtube' => 'nullable',
        'linkdin' => 'nullable',
        'twitter' => 'nullable',
        'facebook' => 'nullable',
        'map' => 'nullable',
        'email_2' => 'nullable',
        'email' => 'nullable',
        'mobile_3' => 'nullable',
        'mobile_2' => 'nullable',
        'mobile' => 'nullable',
        'whatsapp' => 'nullable',
        'app_store_url' => 'nullable',
        'pay_store_url' => 'nullable',
        'mail_status' => 'nullable',
        'mail_mailer' => 'nullable',
        'mail_host' => 'nullable',
        'mail_port' => 'nullable',
        'mail_username' => 'nullable',
        'mail_password' => 'nullable',
        'mail_encryption' => 'nullable',
        'mail_from_address' => 'nullable',
        'mail_from_name' => 'nullable',
    ];
    public function getRouteKeyName() {
        return 'uuid';
    }

    /**
     * Things require during the boot
     */
    protected static function boot() {
        parent::boot();

        //Auto-adding uuid to newly created instances
        self::creating(function (Setting $setting) {
            $setting->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Things require after the boot
     */
    protected static function booted() {
        parent::booted();

        static::creating(function(Setting $setting){

        });
    }

    /**
     * Get Object by UUID
     *
     * @param $query
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function scopeFindWithUuid($query,$uuid,$with = []){
        return $query->where('uuid',$uuid)->with($with)->firstOrFail();
    }




    /**
     * Things require after the boot
     */


    public function getAvatarUrlAttribute(){
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'setting');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType,['image/gif','image/png','image/jpeg']);
            })
            ->withResponsiveImages()
            ->singleFile();

        $this
            ->addMediaCollection('favicon')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType,['image/gif','image/png','image/jpeg','image/x-icon','image/svg+xml']);
            })
            ->singleFile();

        $this
            ->addMediaCollection('header_logo')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType,['image/gif','image/png','image/jpeg','image/svg+xml']);
            })
            ->singleFile();

        $this
            ->addMediaCollection('footer_logo')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType,['image/gif','image/png','image/jpeg','image/svg+xml']);
            })
            ->singleFile();
    }

    /**
     * Register Media Conversions.
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb_100x100')
            ->width(100)
            ->height(100)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('avatar');

        $this->addMediaConversion('thumb_250x250')
            ->width(250)
            ->height(250)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('avatar');
    }

    public function setMailPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['mail_password'] = encrypt($value);
        }
    }

    public function getMailPasswordAttribute($value)
    {
        if (!empty($value)) {
            try {
                return decrypt($value);
            } catch (\Exception $e) {
                return $value;
            }
        }
        return $value;
    }
}
