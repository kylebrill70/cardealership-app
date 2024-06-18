<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Gender::factory()->create([
            'gender'=>'Male'
        ]);

        \App\Models\Gender::factory()->create([
            'gender'=>'Female'
        ]);

        \App\Models\Partstype::factory()->create([
            'part_type'=>'Accessories'
        ]);

        \App\Models\Partstype::factory()->create([
            'part_type'=>'Bolts'
        ]);

        \App\Models\Partstype::factory()->create([
            'part_type'=>'EngineParts'
        ]);

        \App\Models\Cartype::factory()->create([
            'car_type'=>'Sedan'
        ]);

        \App\Models\Cartype::factory()->create([
            'car_type'=>'SportsCar'
        ]);

        \App\Models\Cartype::factory()->create([
            'car_type'=>'Touring'
        ]);



    }
}
