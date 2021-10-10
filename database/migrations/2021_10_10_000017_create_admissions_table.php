<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('code_ds_gender');
            $table->date('dob')->nullable();
            $table->string('married');
            $table->float('height', 15, 2)->nullable();
            $table->decimal('minimum_income', 15, 2)->nullable();
            $table->datetime('date_time')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('size')->nullable();
            $table->time('time')->nullable();
            $table->longText('text_area')->nullable();
            $table->boolean('checkbox')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
