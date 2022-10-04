<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPersonField extends Model
{
    use HasFactory;

    protected $fillable = ['name','value','category_person_id','owner'];

    //Relación uno a muchos inversa.
 
    public function category()
    {
        return $this->belongsTo('App\Models\CategoryPerson');
    }

}
