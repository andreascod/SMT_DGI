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
        Schema::create('transactions', function (Blueprint $table) {
           $table->increments('Id_trans');
           $table->unsignedInteger('Id_compte');
           $table->decimal('montan');
           $table->string('type');
            $table->timestamps();

            $table->foreign('Id_compte')
                  ->references('Id_compte')
                  ->on('comptes')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
