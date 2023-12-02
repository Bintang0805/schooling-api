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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("school_id");
            $table->string("topic");
            $table->string("description");
            $table->dateTime("start_date");
            $table->string("password");
            $table->enum("status", ["Coming Soon", "On Going", "Finished"]);
            $table->string("link");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            $table->foreign("school_id")->references("id")->on("schools")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
