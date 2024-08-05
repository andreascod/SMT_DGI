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
        Schema::create('rapports', function (Blueprint $table) {
            $table->increments('Id_rapport');
            $table->unsignedInteger('Id_util');
            $table->string('titre');
            $table->text('contenue');
            $table->timestamp('date_generation')->useCurrent();
            $table->foreign('Id_util')
            ->references('Id_util')
            ->on('utilisateurs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
