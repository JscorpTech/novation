<?php

namespace Database\Seeders;

use App\Models\Subscribe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscribe::query()->create([
            "plan_id" => 1,
            "user_id" => 1,
            "status" => "active",
            "quantity" => 6,
            "card_id" => 1,
        ]);
    }
}
