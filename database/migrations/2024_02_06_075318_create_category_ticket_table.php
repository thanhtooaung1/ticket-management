<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('ticket_id');
            $table->unsignedBiginteger('category_id');


            $table->foreign('ticket_id')->references('id')
                ->on('tickets')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('category_ticket');
    }
}
