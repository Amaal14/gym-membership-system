<?php

namespace Database\Seeders;

use App\Models\AttendanceRecord;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 3 visits for each member (user ids 5 to 14) in the last two weeks
        foreach (range(5, 14) as $memberId) {
            foreach ([2, 6, 11] as $daysAgo) {
                $in = now()->subDays($daysAgo + $memberId % 3)->setTime(17 + $memberId % 4, 0);

                AttendanceRecord::create([
                    'member_id' => $memberId,
                    'check_in' => $in,
                    'check_out' => $in->copy()->addMinutes(60 + $memberId * 3),
                ]);
            }
        }
    }
}
