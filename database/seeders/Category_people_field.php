<?php

namespace Database\Seeders;

use App\Models\CategoryPersonField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_people_field extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPersonField::create([
            'category_person_id' => 1, //personal
            'owner' =>  1,
            'name' => 'cedula',
            'value' => '1088358245',
        ]);

        CategoryPersonField::create([
            'category_person_id' => 1, //personal
            'owner' =>  1,
            'name' => 'telefono',
            'value' => '3166052930',
        ]);

        CategoryPersonField::create([
            'category_person_id' => 1, //personal
            'owner' =>  1,
            'name' => 'rh',
            'value' => 'A-',
        ]);

        CategoryPersonField::create([
            'category_person_id' => 2, //personal
            'owner' =>  1,
            'name' => 'empresa',
            'value' => 'UAM',
        ]);

        CategoryPersonField::create([
            'category_person_id' => 2, //personal
            'owner' =>  1,
            'name' => 'latitud',
            'value' => '141414',
        ]);

        CategoryPersonField::create([
            'category_person_id' => 2, //personal
            'owner' =>  1,
            'name' => 'longitud',
            'value' => '141414',
        ]);
    }
}
