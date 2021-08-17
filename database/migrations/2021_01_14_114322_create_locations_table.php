<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('locations', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('Description')->nullable();
            $table->string('tags')->nullable();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('locations');
    }
}
