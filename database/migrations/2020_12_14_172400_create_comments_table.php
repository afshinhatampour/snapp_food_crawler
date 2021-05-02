<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('commentId');
            $table->date('createdDate');
            $table->string('sender');
            $table->string('customerId');
            $table->text('commentText');
            $table->integer('rate');
            $table->string('feeling');
            $table->integer('status');
            $table->string('expeditionType');
            $table->text('foods');
            $table->text('replies');
            $table->string('restaurant_vendor_id');
            $table->string('restaurant_city');
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
        Schema::dropIfExists('comments');
    }
}
