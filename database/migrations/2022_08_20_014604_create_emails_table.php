<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /** @return void */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->integer('apps_id')
                ->foreign('apps_id')
                ->references('id')
                ->on('apps');
            $table->tinyInteger('active');
        });
    }

    /** @return void */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
