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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 50);
            $table->string('first_player_name', 20)->nullable();
            $table->string('second_player_name', 20)->nullable();
            $table->string('first_player_strategy', 20)->nullable();
            $table->string('second_player_strategy', 20)->nullable();
            $table->string('first_player_castle', 20)->nullable();
            $table->string('second_player_castle', 20)->nullable();
            $table->string('remark', 100)->nullable();
            $table->text('record');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};
