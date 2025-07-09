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
        Schema::create('jangbus', function (Blueprint $table) {
            $table->id();
			
			$table->tinyinteger('io29')->nullable();
			$table->date('writeday29')->nullable();
			$table->integer('products_id29')->nullable();
			$table->integer('price29')->nullable();
			$table->integer('numi29')->nullable();
			$table->integer('numo29')->nullable();
			$table->integer('prices29')->nullable();
			$table->string('bigo29', 20)->nullable();
			
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
        Schema::dropIfExists('jangbus');
    }
};
