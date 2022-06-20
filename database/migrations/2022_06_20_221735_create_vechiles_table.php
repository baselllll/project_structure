<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVechilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vechiles', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('number')->nullable();
            $table->string('color')->nullable();
            $table->string('YearOfReg')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vechiles');
    }
}
