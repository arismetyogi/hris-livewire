<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->id();
            $table->string('urban');
            $table->string('subdistrict');
            $table->string('city');

            $table->string('province_code');
            $table->foreign('province_code')
                ->references('code')
                ->on('provinces');

            $table->integer('zipcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zips');
    }
};
