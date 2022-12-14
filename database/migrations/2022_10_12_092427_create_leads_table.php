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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('dob')->nullable();
            $table->string('region')->nullable();
            $table->string('credit_score')->nullable();
            $table->string('heath_conditions')->nullable();
            $table->string('covid19_exposed')->nullable();
            $table->string('existing_insurance')->nullable();
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
        Schema::dropIfExists('leads');
    }
};
