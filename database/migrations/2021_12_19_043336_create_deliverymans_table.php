<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverymansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverymans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('uname',50);
            $table->string('password',50);
            $table->string('email',50);
            $table->string('phone',50);
            $table->date('dob');
            $table->string('gender',10);
            $table->date('joining_date');
            $table->text('address');
            $table->text('image');
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
        Schema::dropIfExists('deliverymans');
    }
}
