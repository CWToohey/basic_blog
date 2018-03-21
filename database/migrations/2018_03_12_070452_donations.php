<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Donations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount');
            $table->double('decimalAmt');
            $table->string('fullName');
            $table->string('email');
            $table->string('occupation');
            $table->string('employer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donators');
    }
}
