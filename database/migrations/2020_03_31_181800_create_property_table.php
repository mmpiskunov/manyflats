<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('house', 15)->nullable();
            $table->unsignedInteger('floor')->default(0);
            $table->unsignedInteger('floors')->default(0);
            $table->unsignedInteger('rooms')->default(0);
            $table->decimal('space', 8, 2)->unsigned()->default(0);
            $table->decimal('price', 8, 2)->unsigned()->default(0);
            $table->decimal('price2m', 8, 2)->unsigned()->default(0);
            $table->decimal('rent', 8, 2)->unsigned()->default(0);
            $table->decimal('rent2m', 8, 2)->unsigned()->default(0);
            $table->decimal('payback', 8, 2)->unsigned()->default(0);
            $table->decimal('profit', 8, 2)->unsigned()->default(0);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('link')->nullable();
            $table->text('search')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
