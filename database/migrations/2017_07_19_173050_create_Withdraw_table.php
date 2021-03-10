<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Withdraw', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->string('status', 50)->nullable();
            $table->decimal('admin', 16, 4)->default(0);
            $table->decimal('amount', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['member_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Withdraw');
    }
}
