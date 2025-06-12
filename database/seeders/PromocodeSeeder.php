<?php

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class PromocodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promocode::query()->create([
            "code" => "1234",
            "discount" => 10,
            "quantity" => 5,
            "exp" => Date::now()->addMinute(),
        ]);
    }
}
