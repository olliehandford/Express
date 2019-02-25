<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function(Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
            $table->string('customer_id');
            $table->timestamps();
        });

        Schema::create('payments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('subscription_id');
            $table->foreign('subscription_id')
                    ->references('id')->on('subscriptions')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->string('amount');
            $table->string('payer_name');
            $table->string('payer_email');
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
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('payments');
    }
}
