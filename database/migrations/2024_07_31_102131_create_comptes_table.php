<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->increments('Id_compte');
            $table->unsignedInteger('Id_util'); 
            $table->decimal('solde')->default(0.000); 
            // $table->date('date_creation_compte');
            $table->timestamps();

            $table->foreign('Id_util')
                ->references('Id_util')
                ->on('utilisateurs')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
