<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TripStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('courier_id');
            $table->enum('status', [
                TripStatusEnum::ASSIGNED->value,
                TripStatusEnum::AT_VENDOR->value,
                TripStatusEnum::PICKED->value,
                TripStatusEnum::DELIVERED->value,
                ]);
            $table->timestamp('event_time');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders')->restrictOnDelete();
            $table->foreign('courier_id')->references('id')->on('couriers')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
