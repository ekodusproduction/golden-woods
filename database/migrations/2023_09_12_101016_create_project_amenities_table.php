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
        Schema::create('project_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("projectId");
            $table->foreign("projectId")->references("id")->on("projects");
            $table->unsignedBigInteger("amenityId");
            $table->foreign("amenityId")->references("id")->on("amenities");
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
        Schema::dropIfExists('project_amenities');
    }
};
