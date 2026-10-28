<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id('plan_id');
            // both are user_id values from the Membership service (other database)
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('trainer_id');
            $table->string('title');
            $table->string('goal')->nullable();
            $table->text('exercises'); // written by the trainer, one exercise per line
            $table->date('start_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
