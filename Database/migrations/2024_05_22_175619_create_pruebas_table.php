<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (App::environment('testing')) {
            Schema::create('pruebas', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment('testing')) {
            Schema::dropIfExists('pruebas');
        }
    }
};

