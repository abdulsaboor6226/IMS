<?php

namespace App\Models;

use App\Traits\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{
    use HasFactory,SoftDeletes,General;
    protected $fillable = ['diary_no','date','branch_id_fk','applicant_name','forwarded_by','received_by','received_date','approved_by','approved_date','product_id_fk','brand_id_fk','stock_out_qty'];

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

    public function brand(){
        return $this->hasOne(Brand::class,'id');
    }
    public function branch(){
        return $this->hasOne(Branch::class,'id');
    }
    public function product(){
       return $this->hasOne(Product::class,'id');
    }
}
