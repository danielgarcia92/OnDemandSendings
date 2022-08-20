<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /** @return void */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /** @return void */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
