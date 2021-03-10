<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Shares_Centre', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('minimum_price', 16, 4)->default(0);
            $table->decimal('current_price', 16, 4)->default(0);
            $table->decimal('raise_by', 16, 4)->default(0);
            $table->unsignedInteger('current_accumulate')->default(0);
            $table->unsignedInteger('raise_limit')->default(200000);
            $table->boolean('always_company')->default(0);
            $table->timestamps();
            
            $table->engine = 'InnoDB';
        });

        Schema::create('Shares_Buy', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0);
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedInteger('amount_left')->default(0);
            $table->decimal('share_price', 16, 4)->default(0);
            $table->decimal('total', 16, 4)->default(0);
            $table->boolean('has_process')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
            $table->index(['share_price', 'has_process']);
        });

        Schema::create('Shares_Sell', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0);
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedInteger('amount_left')->default(0);
            $table->decimal('share_price', 16, 4)->default(0);
            $table->decimal('total', 16, 4)->default(0);
            $table->decimal('cash_point', 16, 4)->default(0);
            $table->decimal('md_point', 16, 4)->default(0);
            $table->decimal('purchase_point', 16, 4)->default(0);
            $table->decimal('admin_fee', 16, 4)->default(0);
            $table->boolean('has_process')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
            $table->index(['share_price', 'has_process']);
        });

        Schema::create('Shares_Sell_Statement', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->default(0);
            $table->unsignedInteger('sell_id')->default(0);
            $table->unsignedInteger('amount')->default(0);
            $table->string('status', 50)->nullable();
            $table->decimal('share_price', 16, 4)->default(0);
            $table->decimal('cash_point', 16, 4)->default(0);
            $table->decimal('md_point', 16, 4)->default(0);
            $table->decimal('purchase_point', 16, 4)->default(0);
            $table->decimal('admin_fee', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['member_id', 'sell_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Shares_Sell_Statement');
        Schema::dropIfExists('Shares_Sell');
        Schema::dropIfExists('Shares_Buy');
        Schema::dropIfExists('Shares_Centre');
    }
}
