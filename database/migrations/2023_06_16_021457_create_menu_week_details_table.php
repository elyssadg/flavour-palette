<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_week_details', function (Blueprint $table) {
            $table->string('week_id');
            $table->foreign('week_id')->references('id')->on('menu_week_headers')->onDelete('cascade')->onUpdatphp('cascade');
            $table->string('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->date('available_date');
            $table->primary(['week_id','menu_id','available_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_week_details');
    }
};
