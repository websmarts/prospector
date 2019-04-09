<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignProspectContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_prospect_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_prospect_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->string('contact_role')->nullable();
            
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
        Schema::dropIfExists('campaign_prospect_contact');
    }
}
