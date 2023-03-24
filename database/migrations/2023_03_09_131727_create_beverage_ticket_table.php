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
        Schema::create('beverage_ticket', function (Blueprint $table){
            $table->primary(['beverage_id','ticket_id']);
            $table->foreignId('beverage_id')->constrained();
            $table->foreignId('ticket_id')->constrained();
            $table->integer('quantity');
            $table->float('amount',5,2);
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
        Schema::dropIfExists('beverage_ticket');
    }
};
