<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_member_id')->default(0);
            $table->unsignedInteger('to_member_id');
            $table->string('from_username', 255)->nullable();
            $table->string('to_username', 255)->nullable();
            $table->string('type', 50)->nullable();
            $table->decimal('amount', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['from_member_id', 'to_member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transfer');
    }
}
