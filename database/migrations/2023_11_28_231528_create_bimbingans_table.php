<?php

use App\Models\Skripsi;
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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();            
            $table->string('nama');
            $table->date('tanggal');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas');
            $table->foreignId('dospem_id')->constrained('dosens');
            $table->foreignId('skripsi_id')->constrained('skripsis');
            $table->foreignId('bab_id')->constrained('babs');
            $table->foreignId('subbab_id')->nullable()->constrained('subbabs');
            $table->enum('status', ['menunggu konfirmasi', 'acc', 'revisi'])->default('menunggu konfirmasi');
            $table->timestamps();

            // Memberikan nama constraint secara eksplisit
            // $table->foreign('dospem_id', 'fk_bimbingans_dospem_id')->references('id')->on('dosens')
            // ->whereIn('id', function ($query) {
            //     $query->select('dosen1_id')->from('skripsis')
            //     ->unionAll(
            //         $query->select('dosen2_id')->from('skripsis')
            //     );
            // });
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
