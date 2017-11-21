<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('offices', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('business_id');
        $table->string('phone');
        $table->string('email');
        $table->string('address');
        $table->decimal('latitude',10,8);
        $table->decimal('longitude',11,8);
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
      Schema::dropIfExists('offices');
    }
  }
