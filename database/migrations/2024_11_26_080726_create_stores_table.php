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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('outlet_sap_id', 6);
            $table->string('name');
            $table->string('store_type')->nullable();
            $table->date('operational_date')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('zip_id')->nullable()->constrained('zips');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
