<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hosts');

        Schema::create('hosts', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('hostname', 512);
            $table->string('ip', 64);
            $table->integer('src')->unsigned();
            $table->integer('bounty_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
