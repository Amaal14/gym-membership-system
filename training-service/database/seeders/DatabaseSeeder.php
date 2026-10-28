<?php

namespace Database\Seeders;

use App\Models\WorkoutPlan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            ['Beginner full body', "Squats 3x12\nPush ups 3x10\nPlank 3x30 sec"],
            ['Weight loss plan', "Jumping jacks 4x20\nLunges 3x12\nTreadmill 20 min"],
            ['Core and flexibility', "Plank 3x40 sec\nCrunches 3x15\nStretching 10 min"],
            ['Strength builder', "Deadlift 4x8\nSquats 4x10\nShoulder press 3x10"],
            ['Cardio starter', "Bike 15 min\nJump rope 3x50\nBurpees 3x10"],
        ];

        // members are user ids 5 to 14
        foreach (range(5, 14) as $i => $memberId) {
            WorkoutPlan::create([
                'member_id' => $memberId,
                'trainer_id' => ($i % 3) + 2, // trainers are user ids 2, 3, 4
                'title' => $plans[$i % 5][0],
                'goal' => 'Train 3 times a week',
                'exercises' => $plans[$i % 5][1],
                'start_date' => now()->subDays($i * 5)->toDateString(),
            ]);
        }
    }
}
