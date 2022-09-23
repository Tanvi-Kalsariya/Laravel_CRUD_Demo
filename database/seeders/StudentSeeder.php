<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        for($i = 1; $i <= 10; $i++){

            $name = $faker->name();
            $slug = Str::slug($name);
            student::insert([
                'name' => $name,
                'email' => $faker->safeEmail,
                'address' => $faker->address,
                'slug' => $slug,
                'photo' => "none.png"
            ]);
        }
    }
}