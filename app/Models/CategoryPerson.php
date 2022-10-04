<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPerson extends Model
{
    use HasFactory;

    protected $fillable = ['name','options'];

    public function fields()
    {
        return $this->hasMany('App\Models\CategoryPersonField');
    }

    public function owners()
    {
        return $this->belongsToMany('App\Models\Person');
    }
}
