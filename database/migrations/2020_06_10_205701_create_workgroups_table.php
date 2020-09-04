<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->text('description')->nullable()->default('This is a default description for this group since none was created during registration. You can edit this content. Thank you...');
            $table->string('group_image')->nullable()->default('cnx247.jpg');
            $table->bigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('owner');
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
        Schema::dropIfExists('workgroups');
    }
}
