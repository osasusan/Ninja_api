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
        Schema::dropIfExists('missions');
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->string('description', 150);
            $table->integer('Number_of_ninjas');
            $table->string('Pay', 100);
            $table->boolean('Priority')->default(false);
            $table->foreignId('client_id')->constrained();
            $table->enum('state', ['Finalized', 'In progress', 'To do']);
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
        Schema::dropIfExists('missions');
    }
};
