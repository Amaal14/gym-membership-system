<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $methods = ['cash', 'card', 'transfer'];

        // one payment for each member (user ids 5 to 14), the last two are still pending
        foreach (range(5, 14) as $i => $memberId) {
            Payment::create([
                'member_id' => $memberId,
                'amount' => [200, 540, 1800][$i % 3],
                'payment_date' => now()->subDays($i * 9)->toDateString(),
                'method' => $methods[$i % 3],
                'status' => $memberId >= 13 ? 'pending' : 'paid',
            ]);
        }
    }
}
