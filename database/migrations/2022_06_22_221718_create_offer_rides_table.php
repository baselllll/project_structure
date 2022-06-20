<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vechile_id')->vechile_id();
            $table->string('location_from')->nullable();
            $table->string('location_to')->nullable();
            $table->string('WhenToGo')->nullable();
            $table->integer('offering_seats')->default(0);
            $table->integer('Max_Speed')->default(0);
            $table->integer('occupied_Seat')->default(0);
            $table->text('needs_desciption')->nullable();
            $table->text('Accept_Offer')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vechile_id')->references('id')->on('vechiles')->onDelete('cascade');
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
        Schema::dropIfExists('offer_rides');
    }
}
