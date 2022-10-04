<?php

namespace Database\Seeders;

use App\Models\CategoryPerson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_people extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPerson::create([
            'name' => 'personal',
            'options' => '{"rh": ["A-", "A", "B", "B-", "O", "O-", "AB"], "other_options": ["Telefono", "Cedula", "Ciudad nacimiento"]}',
        ]);
        CategoryPerson::create([
            'name' => 'laboral',
            'options' => '{"Empresa": ["UAM"], "Latitud oficina": "String", "Longitud oficina": "String"}',
        ]);
    }
}
