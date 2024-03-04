<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function cetakParpols()
    {
        $parpol = DB::table('view_partai_politik')->select('*')->get();
        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Partai Politik'
        ];

        $report = PDF::loadView('parpol.report', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakParpolsById($id)
    {
        // Get the political party by its ID
        $parpol = DB::table('view_partai_politik')->select('*')->where('partai_id', $id)->get();

        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Partai Politik By ID'
        ];

        $report = PDF::loadView('parpol.reportbyid', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('d/m/y'), 6, 2);
        $nama_jam = substr(date('d/m/y'), 0, 2) . substr(date('d/m/y'), 3, 2) . substr(date('h:i:s'), 6, 2);

        return $report->stream('report_' . $nama_tgl . $nama_jam . '.pdf');
    }

    public function cetakJenisPelanggaran()
    {
        $jenis = DB::table('view_jenis_pelanggaran')->select('*')->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Jenis Pelanggaran'
        ];

        $report = PDF::loadView('jenispelanggaran.report', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakJenisPelanggaranById($id)
    {
        $jenis = DB::table('view_jenis_pelanggaran')->select('*')->where('id_jenis_pelanggaran', $id)->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Jenis Pelanggaran By ID '
        ];

        $report = PDF::loadView('jenispelanggaran.report', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }


}
