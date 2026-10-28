<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->unsignedBigInteger('member_id'); // user id from the Membership service
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable(); // empty = still inside the gym
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
