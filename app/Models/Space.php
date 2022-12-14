<?php

namespace App\Models;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['name','description','zone','capacity','longitude','latitude','slug','manager'];

    public function categories()
    {
        return $this->hasMany('App\Models\CategorySpace');
    }

    public function dates()
    {
        return $this->hasMany('App\Models\SpaceReserves');
    }

    //Para que el modelo sea buscable
    public function getSearchResult(): SearchResult
     {
        //$url = route('Api/person.show', $this->slug);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
           //$url
         );
     }
}
