<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bonus_Direct', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->string('from_username', 255)->nullable();
            $table->decimal('amount_cash', 16, 4)->default(0);
            $table->decimal('amount_promotion', 16, 4)->default(0);
            $table->decimal('total')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
        });

        Schema::create('Bonus_Override', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->string('from_username', 255)->nullable();
            $table->decimal('amount_cash', 16, 4)->default(0);
            $table->decimal('amount_promotion', 16, 4)->default(0);
            $table->decimal('total')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
        });

        Schema::create('Bonus_Pairing', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->decimal('amount_cash', 16, 4)->default(0);
            $table->decimal('amount_promotion', 16, 4)->default(0);
            $table->decimal('total')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
        });

        Schema::create('Bonus_Group', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->decimal('amount_cash', 16, 4)->default(0);
            $table->decimal('amount_promotion', 16, 4)->default(0);
            $table->decimal('total')->default(0);
            $table->text('from_usernames')->nullable();
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
        Schema::dropIfExists('Bonus_Group');
        Schema::dropIfExists('Bonus_Pairing');
        Schema::dropIfExists('Bonus_Override');
        Schema::dropIfExists('Bonus_Direct');
    }
}
