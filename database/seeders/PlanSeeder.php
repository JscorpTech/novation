<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::query()->create([
            'name' => "Free",
            'price' => 100.00,
            "description" => "Free plan",
            "free_trial" => 7,
            'duration' => 10,
            "discount" => 20,
        ]);
    }
}
