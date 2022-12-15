<?php

namespace App\Models;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model implements Searchable
{
    
    use HasFactory;

    protected $fillable = ['firstname', 'secondname', 'lastname', 'secondLastname', 'public_email', 'birthday', 'slug', 'image'];


    //Relación uno a uno inversa

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function dependency()
    {
        return $this->belongsTo('App\Models\Space');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\CategoryPerson');
    }

    //relación uno a muchos

    
    public function category_inscription()
    {
        return $this->hasMany('App\Models\CategoryPersonInscription');
    }

    public function events_to_approve()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function booked_events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function reservations_to_approve()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function booked_reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    //Relaciones polimórficas

    //Uno a uno
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    //Para que el modelo sea buscable
    public function getSearchResult(): SearchResult
     {
        //$url = route('Api/person.show', $this->slug);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->firstname . " " . $this->secondname . " " . $this->lastname . " " . $this->secondLastname ,
           //$url
         );
     }
}
