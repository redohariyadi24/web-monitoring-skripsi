<?php

use App\Models\Mahasiswa;
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
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasiswa::class)->constrained()->cascadeOnDelete();
            $table->foreignId('dosen1_id')->constrained('dosens')->cascadeOnDelete();
            $table->foreignId('dosen2_id')->constrained('dosens')->cascadeOnDelete();
            $table->string('judul');
            $table->integer('progres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skripsis');
    }
};
