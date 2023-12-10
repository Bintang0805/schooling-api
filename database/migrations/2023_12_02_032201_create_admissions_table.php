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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("parent_id");
            $table->unsignedBigInteger("course_id");
            $table->string('previous_school_year')->nullable();
            $table->text('physical_disabilities')->nullable();
            $table->string('previous_school_name')->nullable();
            $table->text('document');
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('note')->nullable();
            $table->string('status')->default('Pending');

            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("parent_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("course_id")->references("id")->on("courses")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admissions');
    }
};
