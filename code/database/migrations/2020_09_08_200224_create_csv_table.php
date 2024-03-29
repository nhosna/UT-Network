<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('csv', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });


        Schema::create('csv_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('csv_filename');
            $table->boolean('csv_header')->default(0);
            $table->longText('csv_data');
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
        Schema::dropIfExists('csv_data');
    }
}
