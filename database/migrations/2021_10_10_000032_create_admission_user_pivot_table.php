<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('admission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('admission_id');
            $table->foreign('admission_id', 'admission_id_fk_5084065')->references('id')->on('admissions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_5084065')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
