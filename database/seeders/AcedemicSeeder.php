<?php

namespace Database\Seeders;

use App\Models\Academic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class AcedemicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academic::create([
            ['year' => 1,'khmer' =>'ឆ្មាំទី១','status' => '1',],
            ['year' => 2,'khmer' =>'ឆ្មាំទី២','status' => '1',],
            ['year' => 3,'khmer' =>'ឆ្មាំទី៣','status' => '1',],
            ['year' => 4,'khmer' =>'ឆ្មាំទី៤','status' => '1',],     
        ]);
    }
}
