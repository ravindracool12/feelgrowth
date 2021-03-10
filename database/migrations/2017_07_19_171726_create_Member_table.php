<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 255)->nullable();
            $table->string('secret_password', 255)->nullable();
            $table->string('register_by', 255)->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('direct_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('root_id')->nullable();
            $table->unsignedInteger('level')->default(1);
            $table->unsignedTinyInteger('direct_percent')->default(0);
            $table->unsignedTinyInteger('pairing_percent')->default(0);
            $table->unsignedTinyInteger('group_level')->default(0);
            $table->unsignedTinyInteger('max_pair')->default(0);
            $table->decimal('max_pairing_bonus')->default(0);
            $table->decimal('original_amount', 16, 4)->default(0);
            $table->decimal('package_amount', 16, 4)->default(0);
            $table->decimal('left_total', 16, 4)->default(0);
            $table->decimal('right_total', 16, 4)->default(0);
            $table->enum('position', ['left', 'right', 'top'])->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_group_bonus')->default(0);
            $table->text('left_children')->nullable();
            $table->text('right_children')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
        });

        Schema::create('Member_Wallet', function (Blueprint $table) {
            $table->unsignedInteger('member_id');
            $table->decimal('register_point', 16, 4)->default(0);
            $table->decimal('purchase_point', 16, 4)->default(0);
            $table->decimal('promotion_point', 16, 4)->default(0);
            $table->decimal('cash_point', 16, 4)->default(0);
            $table->decimal('md_point', 16, 4)->default(0);
            $table->boolean('lock_cash')->default(0);
            $table->boolean('lock_promotion')->default(0);
            $table->boolean('lock_register')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary('member_id');
        });

        Schema::create('Member_Wallet_Statement', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->string('username', 255)->nullable();
            $table->string('type', 100)->nullable();
            $table->decimal('register_amount', 16, 4)->default(0);
            $table->decimal('promotion_amount', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('member_id');
        });

        Schema::create('Member_Detail', function (Blueprint $table) {
            $table->unsignedInteger('member_id');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone1', 50)->nullable();
            $table->string('phone2', 50)->nullable();
            $table->string('mobile_phone', 50)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_account_number', 100)->nullable();
            $table->string('bank_account_holder', 255)->nullable();
            $table->string('bank_branch', 255)->nullable();
            $table->string('spouse_name', 255)->nullable();
            $table->string('spouse_dob', 255)->nullable();
            $table->string('identification_number', 255)->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('date_of_birth', 100)->nullable();
            $table->string('beneficiary_name', 255)->nullable();
            $table->string('beneficiary_nationality', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('bank_address')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary('member_id');
        });

        Schema::create('Member_Shares', function (Blueprint $table) {
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedInteger('share_limit')->default(0);
            $table->decimal('current_sales')->default(0);
            $table->decimal('max_share_sale')->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary('member_id');
        });

        Schema::create('Member_Freeze_Shares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('amount')->default(0);
            $table->boolean('has_process')->default(0);
            $table->timestamp('active_date')->nullable();
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
        Schema::dropIfExists('Member_Freeze_Shares');
        Schema::dropIfExists('Member_Shares');
        Schema::dropIfExists('Member_Detail');
        Schema::dropIfExists('Member_Wallet_Statement');
        Schema::dropIfExists('Member_Wallet');
        Schema::dropIfExists('Member');
    }
}
