<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('ticket_id');
            $table->unsignedBiginteger('label_id');


            $table->foreign('ticket_id')->references('id')
                ->on('tickets')->onDelete('cascade');
            $table->foreign('label_id')->references('id')
                ->on('labels')->onDelete('cascade');
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
        Schema::dropIfExists('label_ticket');
    }
}
