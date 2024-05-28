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
        Schema::table('projects', function (Blueprint $table) {
            // Creo la colonna della foreign key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // Assegno la Foreign Key alla colonna creata
            $table->foreign('type_id')
                    ->references('id')
                    ->on('types')
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Eliminiamo la foreign key
            // $table->dropForeign('projects_type_id_foreign'); 1° soluzione
            $table->dropForeign(['type_id']);
            // Elimino la colonna
            $table->dropColumn('type_id');

        });
    }
};
