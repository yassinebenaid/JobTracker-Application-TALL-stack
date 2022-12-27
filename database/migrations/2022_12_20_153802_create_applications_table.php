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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("emploee_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("company_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("job_id")->constrained("thejobs")->cascadeOnDelete();
            $table->string("expected_salary");
            $table->text("cover_letter");
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
        Schema::dropIfExists('applications');
    }
};
