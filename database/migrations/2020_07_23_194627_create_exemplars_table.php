<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class CreateExemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplars', function (Blueprint $table) {
            $table->char('GUID',36);
            $table->unsignedBigInteger('itemID');
            $table->foreign('itemID')->references('id')->on('items')->onDelete('cascade');
            $table->boolean('is_loaned')->default(0);
            $table->string('remarks')->default(NULL);
            $table->timestamps();
            $table->primary(['GUID', 'itemID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exemplars');
    }
}
