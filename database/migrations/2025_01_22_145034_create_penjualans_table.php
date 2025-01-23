<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('billing_address');
            $table->date('transaction_date');
            $table->date('due_date');
            $table->string('transaction_number')->unique();
            $table->string('customer_reference_number')->nullable();
            $table->string('tag')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('product')->nullable();
            $table->text('message')->nullable();
            $table->text('memo')->nullable();
            $table->string('attachment')->nullable();
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->boolean('deductions')->default(false);
            $table->boolean('down_payment')->default(false);
            $table->decimal('remaining_balance', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
