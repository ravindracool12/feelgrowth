<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesReturnStatement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Shares_Return_Statement', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0);
            $table->unsignedInteger('amount')->default(0);
            $table->string('username', 255)->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Shares_Return_Statement');
    }
}
