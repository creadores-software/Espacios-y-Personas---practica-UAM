<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySpace extends Model
{
    use HasFactory;

    protected $fillable = ['name','options'];

    public function fields()
    {
        return $this->hasMany('App\Models\CategorySpaceField');
    }

    public function spaces()
    {
        return $this->belongsToMany('App\Models\Space');
    }
}
