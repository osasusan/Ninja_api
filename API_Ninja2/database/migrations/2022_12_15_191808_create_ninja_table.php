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
        Schema::dropIfExists('ninjas');
        Schema::create('ninjas', function (Blueprint $table)
         {
            $table->id();
            $table->String('name',100);
            $table->String('skills',100);
            $table->enum('rank',['Novato','Soldado ','Veterano','Maestro']);
            $table->enum('state',['Activo','Retirado','Fallecido','Desertor']);
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
        Schema::dropIfExists('ninjas');
    }
};
