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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('website_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->dateTime('scheduled_at');
            $table->boolean('is_sent')->default(false);
            $table->timestamps();

            $table->foreign('website_id')->references('id')->on('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
