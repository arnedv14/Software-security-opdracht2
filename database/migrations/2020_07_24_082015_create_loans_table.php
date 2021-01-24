<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->unsignedBigInteger('loaner');
            $table->foreign('loaner')->references('id')->on('users')->onDelete('cascade');
            $table->char('exemplarID',36);
            $table->foreign('exemplarID')->references('GUID')->on('exemplars')->onDelete('cascade');
            $table->timestamp('start_loan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_loan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('remarks')->default(null);
            $table->primary(['loaner','exemplarID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
