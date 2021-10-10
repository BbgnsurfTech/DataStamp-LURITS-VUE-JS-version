<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAdmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->unsignedBigInteger('belongs_to_id')->nullable();
            $table->foreign('belongs_to_id', 'belongs_to_fk_5084064')->references('id')->on('users');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_5083820')->references('id')->on('users');
        });
    }
}
