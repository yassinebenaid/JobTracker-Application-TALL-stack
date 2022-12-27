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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("country")->nullable();
            $table->string("birthday")->nullable();
            $table->string("degree")->nullable();
            $table->string("school")->nullable();
            $table->string("degree_year")->nullable();
            $table->string("job")->nullable();
            $table->text("bio")->nullable();
            $table->string("experience_years")->nullable();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
