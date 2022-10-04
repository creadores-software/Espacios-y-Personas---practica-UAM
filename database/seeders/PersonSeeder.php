<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person1 = Person::create([
            'firstname' => 'Julian',
            'secondname' => 'David',
            'lastname' => 'Navia',
            'secondLastname' => 'Niño',
            'public_email' => 'julianmensajes@hotmail.es',
            'birthday' => '04/12/1999',
            'slug' => 'julian-david-navia-nino',
        ]);

        Image::factory(1)->create([
            'imageable_id' => $person1->id,
            'imageable_type' => 'App\Models\Person',
            'url' => 'https://cdn.pixabay.com/photo/2022/08/09/19/27/people-7375689_960_720.png'
        ]);

        $person2 = Person::create([
            'firstname' => 'Jorge',
            'secondname' => 'Ivan',
            'lastname' => 'Meza',
            'secondLastname' => 'Martinez',
            'public_email' => 'jivanmeza@hotmail.com',
            'birthday' => '05/05/2000',
            'slug' => 'jorge-ivan-meza-martinez',
        ]);
        
        Image::factory(1)->create([
            'imageable_id' => $person2->id,
            'imageable_type' => 'App\Models\Person',
            'url' => 'https://cdn.pixabay.com/photo/2022/08/09/19/28/people-7375694_960_720.png'
        ]);

        $person3 = Person::create([
            'firstname' => 'Alvaro',
            'secondname' => 'Andres',
            'lastname' => 'Perez',
            'secondLastname' => 'Sanchez',
            'public_email' => 'alvaro.perezs@hotmail.es',
            'birthday' => '08/08/1777',
            'slug' => 'alvaro-andres-perez-sanchez',
        ]);

        Image::create([
            'imageable_id' => $person3->id,
            'imageable_type' => 'App\Models\Person',
            'url' => 'https://cdn.pixabay.com/photo/2022/08/09/19/29/people-7375704_960_720.png'
        ]);


    }
}
