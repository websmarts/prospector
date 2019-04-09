<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('campaign_prospect_id')->unsigned();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('contact_id')->unsigned()->nullable();
            $table->string('activity')->nullable(); // headline
            $table->string('note')->nullable(); // details
            $table->datetime('due')->nullable();
            $table->tinyInteger('status')->default(0);// > 0 == done

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
        Schema::dropIfExists('activities');
    }
}
