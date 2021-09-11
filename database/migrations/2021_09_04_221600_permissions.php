<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users_credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users');
            $table->integer('id_credentials');
            $table->timestampTz('created_at');
        });

        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('id_services');
            $table->integer('id_status');
            $table->integer('id_permissions');
            $table->timestampTz('created_at');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestampsTz();
        });

        Schema::create('permissions', function (Blueprint $table) {
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
        Schema::dropIfExists('users_credentials');
        Schema::dropIfExists('credentials');
        Schema::dropIfExists('services');
        Schema::dropIfExists('permissions');
    }
}
