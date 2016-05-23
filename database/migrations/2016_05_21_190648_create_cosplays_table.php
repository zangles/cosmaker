<?php

use App\Cosplay;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosplays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('status',[Cosplay::PLANNED,Cosplay::IN_PROGRESS,Cosplay::FINISHED]);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cosplays');
    }
}
