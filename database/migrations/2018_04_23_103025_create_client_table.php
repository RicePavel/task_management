<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('fio', 256);
            $table->string('email', 256);
            $table->string('phone', 256);
            $table->integer('status');
        });
        
        Schema::create('administrators', function(Blueprint $table) {
            $table->increments('administrator_id');
            $table->string('fio', 256);
        });
        
        Schema::create('tasks', function(Blueprint $table) {
            $table->increments('task_id');
            $table->string('name', 256);
            $table->text('task_text');
            $table->integer('administrator_id')->unsigned();
            $table->integer('status');
            
            $table->foreign('administrator_id')->references('administrator_id')->on('administrators');
        });
        
        Schema::create('documents', function(Blueprint $table) {
            $table->increments('document_id'); 
            $table->string('name', 256);
            $table->integer('administrator_id')->unsigned()->nullable();
            $table->integer('task_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            
            $table->foreign('administrator_id')->references('administrator_id')->on('administrators');
            $table->foreign('task_id')->references('task_id')->on('tasks');
            $table->foreign('client_id')->references('client_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
