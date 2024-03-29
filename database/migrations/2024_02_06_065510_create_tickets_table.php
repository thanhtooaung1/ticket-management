<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('message');
            $table->enum('priority', [2, 1, 0])->default(2)->comment('high is 2, normal is 1, low is 0');
            $table->enum('status', [0, 1])->default(1)->comment('0 is close, 1 is open');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_user_id')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
