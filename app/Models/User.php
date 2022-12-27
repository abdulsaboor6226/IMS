<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\General;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,HasRoles,SoftDeletes,General;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','phone','profile_image_url','status_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token','created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getProfileImageUrlAttribute($value){
        return url(Storage::url($value));
    }
    protected static function boot()
    {

        parent::boot();

        if (Auth::check()){
            // updating created_by and updated_by when model is created
            static::creating(function ($model) {
                if (!$model->isDirty('created_by')) {
                    $model->created_by = auth()->user()->id;
                }
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            });

            // updating updated_by when model is updated
            static::updating(function ($model) {
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            });

            // deleting deleting_by when model is updated
            static::deleted(function ($model) {
                if (!$model->isDirty('deleted_by')) {
                    $model->deleted_by = auth()->user()->id;
                    $model->save();
                }
            });
        }
    }

    public function status(){
        return $this->belongsTo(Dictionary::class,'status_id')->withDefault(dictionaryDefault());
    }
}
