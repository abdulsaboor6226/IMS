<?php

namespace App\Traits;

use PHPUnit\Framework\MockObject\BadMethodCallException;

trait General{
    public function scopeLike($query,$column,$value){
        return $query->where($column,'LIKE','%'.$value.'%');
    }

}
