<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberBtcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('Coin_Wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('coin_type', 10)->default('btc');
            $table->string('username', 255)->nullable();
            $table->string('wallet_name', 255);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['member_id', 'created_at']);
        });

        \Schema::create('Coin_Address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wallet_id')->default(0);
            $table->text('info')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['wallet_id', 'created_at']);
        });

        \Schema::create('Coin_Transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('coin_type', 10)->default('btc');
            $table->string('username', 255)->nullable();
            $table->decimal('amount', 16, 8)->default(0);
            $table->text('from_address')->nullable();
            $table->text('to_address')->nullable();
            $table->text('hash_value')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['member_id', 'created_at']);
        });

        \Schema::create('Coin_Admin', function (Blueprint $table) {
            $table->increments('id');
            $table->text('wallet_address');
            $table->string('coin_type', 10)->default('btc');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('coin_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('Coin_Admin');
        \Schema::dropIfExists('Coin_Transaction');
        \Schema::dropIfExists('Coin_Address');
        \Schema::dropIfExists('Coin_Wallet');
    }
}
