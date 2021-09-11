<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_indicators', function (Blueprint $table) {
            $table->id();
            $table->integer('id_projects');
            $table->integer('id_indicators');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestampTz('created_at');
        });

        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('id_measurements');
            $table->string('name');
            $table->integer('amount');
            $table->timestampTz('from');
            $table->timestampTz('to');
            $table->timestampsTz();
        });

        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
