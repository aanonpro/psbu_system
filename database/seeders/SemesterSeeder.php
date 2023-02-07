<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            ['name' => 1,'khmer' =>'ឆមាសទី១','status' => '1', 'trash' => '0'],
            ['name' => 1,'khmer' =>'ឆមាសទី២','status' => '1', 'trash' => '0'],  
        ]);
    }
}
