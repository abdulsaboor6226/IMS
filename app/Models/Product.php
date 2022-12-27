<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','stock_date','product_type_id_fk','vendor_id_fk','brand_id_fk','unit_price','unit_quantity','status_id'];

    protected $hidden = ['created_by','updated_by','deleted_by','created_at','updated_at','deleted_at' , 'password', 'remember_token','email_verified_at'];

    protected static function boot()
    {
        parent::boot();
        if (auth()->check()) {
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

    public function productType(){
        return $this->belongsTo(ProductType::class,'product_type_id_fk');
    }
    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id_fk');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id_fk');
    }
    public function status()
    {
        return $this->belongsTo(Dictionary::class,'status_id')->withDefault(dictionaryDefault());
    }
}
