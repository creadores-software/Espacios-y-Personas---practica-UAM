<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceReserves extends Model
{
    use HasFactory;

    protected $fillable = ['date','title','space_id','description','reserve'];

    public function space()
    {
        return $this->belongsToMany('App\Models\Space');
    }
}
