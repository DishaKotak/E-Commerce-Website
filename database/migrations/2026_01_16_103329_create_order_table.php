<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->integer('user_id')->nullable();
            $table->decimal('total_amount', 22, 5);
            $table->text('shipping_address');
            $table->text('billing_address');
            $table->string('phone_no');
            $table->string('status')->default('pending');
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
