<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ids are fixed because the other services use them:
        // 1 = admin, 2-4 = trainers, 5-14 = members. password for all: password
        User::create(['user_id' => 1, 'name' => 'Noura Alharbi', 'email' => 'admin@gym.com', 'password' => 'password', 'role' => 'admin']);

        User::create(['user_id' => 2, 'name' => 'Reem Alotaibi', 'email' => 'trainer@gym.com', 'password' => 'password', 'role' => 'trainer']);
        User::create(['user_id' => 3, 'name' => 'Hessa Alzahrani', 'email' => 'trainer2@gym.com', 'password' => 'password', 'role' => 'trainer']);
        User::create(['user_id' => 4, 'name' => 'Lama Alshehri', 'email' => 'trainer3@gym.com', 'password' => 'password', 'role' => 'trainer']);

        $members = ['Sara Alqahtani', 'Fatimah Alghamdi', 'Maha Aldosari', 'Shahad Almutairi', 'Joud Alanazi',
            'Raghad Alshammari', 'Dana Alsubaie', 'Lujain Alyami', 'Wejdan Alharthi', 'Ghada Albalawi'];
        $types = ['monthly', 'quarterly', 'yearly'];

        foreach ($members as $i => $name) {
            $user = User::create([
                'user_id' => $i + 5,
                'name' => $name,
                'email' => $i == 0 ? 'member@gym.com' : 'member'.($i + 1).'@gym.com',
                'password' => 'password',
                'role' => 'member',
                'phone' => '05500000'.str_pad($i + 5, 2, '0', STR_PAD_LEFT),
            ]);

            $type = $types[$i % 3];
            $start = now()->subDays($i * 9);
            $end = $start->copy()->addMonths(Membership::$months[$type]);

            Membership::create([
                'user_id' => $user->user_id,
                'type' => $type,
                'start_date' => $start,
                'end_date' => $end,
                'status' => $end->isPast() ? 'expired' : 'active',
            ]);
        }
    }
}
