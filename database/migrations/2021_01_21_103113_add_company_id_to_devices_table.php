<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::table('devices', function (Blueprint $table) {
            
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');

        });
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('devices', function (Blueprint $table) {
            //
        });
    }
}
