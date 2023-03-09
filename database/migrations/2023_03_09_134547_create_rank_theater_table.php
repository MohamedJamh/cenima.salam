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
        Schema::create('rank_theater', function (Blueprint $table){
            $table->primary(['rank_id','theater_id']);
            $table->foreignId('rank_id')->constrained();
            $table->foreignId('theater_id')->constrained();
            $table->integer('row_label');
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
        Schema::dropIfExists('rank_theater');
    }
};
