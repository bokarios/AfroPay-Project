<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 191)->unique();
            $table->string('gateway_id');
            $table->enum('interval', ['day', 'week', 'month', 'year']);
            $table->decimal('price', 6, 2);
            $table->boolean('active')->default(false);
            $table->boolean('teams_enabled')->default(false);
            $table->integer('teams_limit')->nullable();
            $table->integer('trial_period_days')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
