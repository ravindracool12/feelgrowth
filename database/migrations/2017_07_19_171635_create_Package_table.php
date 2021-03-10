<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Package', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('direct_percent')->default(0);
            $table->unsignedTinyInteger('pairing_percent')->default(0);
            $table->unsignedTinyInteger('group_level')->default(0);
            $table->unsignedTinyInteger('max_pair')->default(0);
            $table->unsignedInteger('share_limit')->default(0);
            $table->decimal('max_pairing_bonus')->default(0);
            $table->decimal('package_amount', 16, 4)->default(0);
            $table->decimal('max_share_sale')->default(0);
            $table->decimal('purchase_point', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Package');
    }
}
