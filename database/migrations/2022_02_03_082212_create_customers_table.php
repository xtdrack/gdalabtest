<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('dni');
            $table->unsignedBigInteger('id_reg');
            $table->unsignedBigInteger('id_com');
            
            $table->string('email')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('address')->nullable();
            $table->string('date_reg');
            $table->string('status');

            $table->foreign('id_reg')->references('id_reg')->on('regions')->onDelete('cascade');
            $table->foreign('id_com')->references('id_com')->on('communes')->onDelete('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
