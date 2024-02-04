<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_pelanggaran AS
            SELECT
                pelanggarans.id,
                jenis_pelanggarans.jenis_pelanggaran,
                parpols.nama_partai,
                pelanggarans.status_peserta_pemilu,
                pelanggarans.nama_bacaleg,
                pelanggarans.bukti,
                pelanggarans.tanggal_input,
                pelanggarans.keterangan,
                pelanggarans.created_at,
                pelanggarans.updated_at
            FROM pelanggarans
            INNER JOIN jenis_pelanggarans ON pelanggarans.jenis_pelanggaran_id = jenis_pelanggarans.id
            INNER JOIN parpols ON pelanggarans.partai_id = parpols.id
        "); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_pelanggaran');
    }
};
