<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            \App\Models\Data::insert([
                'data' => random_int(240, 360) / 10,
                'user_id' => 1,
                'sensor_id' => 1,
                'node_id' => 1,
                'created_at' => Carbon::now()->subDays(random_int(0, 14)),
                'updated_at' => Carbon::now()->subDays(random_int(0, 14)),
            ]);
        }
    }
}
