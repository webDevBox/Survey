<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeployedToDeviceSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_surveys', function (Blueprint $table) {
            $table->boolean('isDeployed')->default(0)->after('survey_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_surveys', function (Blueprint $table) {
            $table->dropColumn('isDeployed');
        });
    }
}
