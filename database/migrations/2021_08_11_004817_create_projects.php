<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestampsTz();
        });

        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->timestampsTz();
        });

        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->integer('id_farmer');
            $table->string('name', 150);
            $table->timestampsTz();
        });

        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->integer('id_farm');
            $table->string('cod_car')->unique();
        });

        Schema::create('projects_has_farms', function (Blueprint $table) {
            $table->id();
            $table->integer('id_project');
            $table->integer('id_farm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('farmers');
        Schema::dropIfExists('farms');
    }
}
