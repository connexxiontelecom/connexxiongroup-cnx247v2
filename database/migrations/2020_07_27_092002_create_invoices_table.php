<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->integer('invoice_no');
            $table->tinyInteger('tax_inclusive')->nullable(); //1=yes; 0=no
            $table->dateTime('issue_date');
            $table->dateTime('due_date');
            $table->double('total');
            $table->double('sub_total');
            $table->integer('tax_rate')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->double('tax_value')->default(0)->nullable();
            $table->double('discount_value')->default(0)->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('status')->default(0); //pending
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
        Schema::dropIfExists('invoices');
    }
}
