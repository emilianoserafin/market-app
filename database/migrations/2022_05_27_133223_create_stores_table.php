<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('farm_name')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('business_id');
            $table->string('street_address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('farm_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farms');
    }
};
