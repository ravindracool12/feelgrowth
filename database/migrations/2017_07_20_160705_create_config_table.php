<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50)->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('key');
        });

        Schema::create('Admin_Fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 255)->nullable();
            $table->string('type')->nullable();
            $table->decimal('amount', 16, 4)->default(0);
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('created_at');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Admin_Fees');
        Schema::dropIfExists('Config');
    }
}
