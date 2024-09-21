<?php

namespace Database\Seeders;

use App\Models\Todolist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');
   

        for ($i = 1; $i <= 5; $i++) {
            Todolist::create([
                'todo' => $faker->sentence,
                 'studentID' => 1,
                'is_completed' => $faker->boolean,
            ]);
        
    }}
}
 