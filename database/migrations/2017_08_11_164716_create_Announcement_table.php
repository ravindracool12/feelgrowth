<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Announcement', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en', 255)->nullable();
            $table->string('title_chs', 255)->nullable();
            $table->string('title_cht', 255)->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_chs')->nullable();
            $table->text('content_cht')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Announcement');
    }
}
