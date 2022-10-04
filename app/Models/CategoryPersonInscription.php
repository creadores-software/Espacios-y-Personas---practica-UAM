<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPersonInscription extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function categoryPerson()
    {
        return $this->belongsTo('App\Models\CategoryPerson');
    }


}
