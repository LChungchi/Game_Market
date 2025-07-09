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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
			
			$table->string('genre', 20)->nullable();
			$table->string('rated', 10)->nullable();
			$table->string('gname', 255)->nullable();
			$table->string('platform_id', 20)->nullable();
			$table->string('publisher_id', 50)->nullable();
			$table->integer('price')->nullable();
			$table->string('information', 255);
			$table->date('release')->nullable();
			
			$table->tinyinteger('new');
			$table->tinyinteger('sale');
			$table->tinyinteger('hit');
			$table->integer('discount');
			$table->string('pic1', 255);
			$table->string('pic2', 255);
			
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
        Schema::dropIfExists('games');
    }
};
