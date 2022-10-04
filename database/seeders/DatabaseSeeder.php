<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $filepath = storage_path('people');
        if(!File::exists($filepath)){
            File::makeDirectory($filepath);  //follow the declaration to see the complete signature
        }
        //$this->call(UserSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(Category_people::class);
        $this->call(Category_people_field::class);
    }
}
