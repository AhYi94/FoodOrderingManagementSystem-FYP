<?php

use App\Models\Quota;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quota::create(array(
            'user_id' => 1,
            'balance' => 20,
        ));
    }
}
