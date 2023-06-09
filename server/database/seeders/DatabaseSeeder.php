<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Branch;
use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $account_types = ['Savings', 'Current', 'Checking', 'Loan'];

        foreach ($account_types as $type) {
            DB::table('account_types')->insert([
                'name' => $type,
                'description' => $type . ' Account Description',
            ]);
        }

        for($i = 0; $i < 10; $i++){
            DB::table('branches')->insert([
                'name'          => fake()->city(),
                'location'      => fake()->address(),
                'contact_info'  => fake()->phoneNumber(),
            ]);
        }

        for($i = 1; $i <= 10; $i++){

            $account_type = AccountType::inRandomOrder()->first();
            $branch       = Branch::inRandomOrder()->first();

            $statuses = ['pending', 'deposit', 'withdrawal', 'restricted', 'frozen', 'inactive', 'active'];
            // $k = array_rand($statuses);
            // $v = $statuses[$k];

            DB::table('accounts')->insert([
                'account_number'   => $i,
                'balance'          => rand(1000, 10000000),
                'status'           => $statuses[array_rand($statuses)],
                'branch_id'        => $branch->id,
                'account_type_id'  => $account_type->id,
            ]);
        }
    }
}
