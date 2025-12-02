<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Tabla: badges
    Schema::create('badges', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->text('criteria');
        $table->string('image_url', 500)->nullable();
        $table->string('issuer')->default('Eduhive');
        $table->timestamps(); // Esto crea created_at y updated_at
        
        $table->index('name');
    });

    // Tabla: assertions (Emisiones)
    Schema::create('assertions', function (Blueprint $table) {
        $table->id();
        $table->string('assertion_id', 100)->unique();
        $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
        $table->string('recipient_name');
        $table->string('recipient_email');
        $table->string('recipient_hash');
        $table->dateTime('issued_on');
        $table->string('evidence', 500)->nullable();
        $table->timestamps();

        $table->index('recipient_email');
    });

    // Tabla: api_keys
    Schema::create('api_keys', function (Blueprint $table) {
        $table->id();
        $table->string('api_key', 100)->unique();
        $table->string('name');
        $table->boolean('active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges_tables');
    }
};
