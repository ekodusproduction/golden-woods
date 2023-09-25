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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("projectName")->unique()->nullable();
            $table->string("status")->nullable();
            $table->string("projectImage")->nullable();
            $table->string("projectVideo")->nullable();
            $table->string("description")->nullable();
            $table->string("location",255)->nullable();
            $table->string("approvedPlan")->nullable();
            $table->string("brochure")->nullable();
            $table->string("projectNoc")->nullable();
            $table->tinyInteger("isActive")->default(0);
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
        Schema::dropIfExists('projects');
    }
};
