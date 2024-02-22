<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW view_partai_politik AS
        WITH view_partai_politik AS (
            SELECT 
                prt.id AS partai_id,
                prt.nomor_partai AS nomor_partai, 
                prt.nama_partai AS nama_partai, 
                prt.photo AS photo_partaiusers, 
                COUNT(plg.id) AS jumlah_pelanggaran
            FROM 
                parpols prt
            LEFT JOIN 
                pelanggarans plg ON prt.id = plg.partai_id
            GROUP BY 
                prt.id, prt.nomor_partai, prt.nama_partai, prt.photo
        )
        SELECT 
            partai_id,
            nomor_partai,
            nama_partai,
            photo_partaiusers,
            jumlah_pelanggaran,
            SUM(jumlah_pelanggaran) OVER() AS total_pelanggaran
        FROM 
            view_partai_politik;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW view_partai_politik');
    }
};