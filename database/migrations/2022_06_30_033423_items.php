<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();           
            $table->integer('user_id');
            $table->integer('category_id');
            $table->text('category_name',100);
            $table->text('task');
            $table->string('name', 100);    
            $table->boolean('public')->default(0);
            $table->boolean('done')->default(0);
            $table->dateTime('dateTime');         
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
};
