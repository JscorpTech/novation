<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Card::query()->create([
            "card_number" => "1234567890123456",
            "card_exp" => "2309",
            "card_token" => "121",
            "user_id" => 1,
            "status" => "active",
        ]);
    }
}
