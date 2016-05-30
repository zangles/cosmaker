<?php

use App\CosplayPart;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosplayPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosplay_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cosplay_id')->unsigned();
            $table->string('name');
            $table->integer('progress')->default(0);
            $table->text('description')->nullable();
            $table->enum('status', [CosplayPart::STATUS_PLANNED,CosplayPart::STATUS_IN_PROGRESS,CosplayPart::STATUS_FINISHED]);
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
        Schema::drop('cosplay_parts');
    }
}
