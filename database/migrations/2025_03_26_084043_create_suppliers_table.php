<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact_person_name');
            $table->text('address');
            $table->string('phone', 11)->unique();            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};