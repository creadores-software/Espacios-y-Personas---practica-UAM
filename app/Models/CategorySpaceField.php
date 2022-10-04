<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySpaceField extends Model
{
    use HasFactory;
    protected $fillable = ['name','value','category_space_id','space'];

    //Relación uno a muchos inversa.
 
    public function category()
    {
        return $this->belongsTo('App\Models\CategorySpace');
    }
}
