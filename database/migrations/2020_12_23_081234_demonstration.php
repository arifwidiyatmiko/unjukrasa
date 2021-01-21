<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Demonstration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demonstration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('id_city')->nullable();
            $table->unsignedBigInteger('id_allience')->nullable();
            $table->boolean('is_astra')->default(0)->change();
            $table->longText('status');
            $table->longText('issue');
            $table->boolean('is_rengiang')->default(0)->change();
            $table->text('basis_universitas')->nullable();
            $table->unsignedInteger('mass_amount');
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
        Schema::dropIfExists('demonstration');
    }
}
