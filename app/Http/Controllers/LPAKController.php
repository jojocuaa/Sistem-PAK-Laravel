<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class LPAKController extends Controller
{
    public function addLPAK()
    {

        return view('lpak.addnew');
    }
    public function storeLPAK(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:pegawai,nip',
            'no_kartu_asn' => 'nullable|string|max:50',
            'tempatlahir' => 'required|string|max:100',
            'tanggallahir' => 'required|string|max:20',
            'pendidikan' => 'nullable|string|max:50',
            'instansipendidikan' => 'nullable|string|max:100',
            'prodi' => 'nullable|string|max:100',
            'pangkat' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:20',
            'tmt_pangkat' => 'nullable|date_format:d-m-Y',
            'jabatan' => 'nullable|string|max:100',
            'tmt_jabatan' => 'nullable|date_format:d-m-Y',
            'unit_kerja' => 'nullable|string|max:100',
            'instansi' => 'nullable|string|max:255',
        ]);

        // Simpan ke tabel pegawai
        DB::table('pegawai')->insert([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'nomor_kartu' => $request->no_kartu_asn,
            'tempat_lahir' => $request->tempatlahir,
            'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('-', '/', $request->tanggallahir))),
            'pendidikan_terakhir' => $request->pendidikan,
            'instansipendidikan' => $request->instansipendidikan,
            'prodi' => $request->prodi,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'tmt_pangkat' => $request->tmt_pangkat ? date('Y-m-d', strtotime($request->tmt_pangkat)) : null,
            'jabatan' => $request->jabatan,
            'tmt_jabatan' => $request->tmt_jabatan ? date('Y-m-d', strtotime($request->tmt_jabatan)) : null,
            'unit_kerja' => $request->unit_kerja,
            'instansi' => $request->instansi,

        ]);

        return redirect()->route('admin.index')->with('success', 'Data pegawai berhasil disimpan!');
    }
    public function searchNama(Request $request)
    {
        try {
            $searchTerm = $request->input('term');

            // Logika pencarian berdasarkan $searchTerm, misalnya di tabel Dosen
            $results = DB::table('pegawai')
                ->select('nama', 'nip')
                ->where('nama', 'like', '%' . $searchTerm . '%')
                ->get();

            // Tambahkan pernyataan log sebelum mengembalikan respons
            \Log::info(' request with term: ' . $searchTerm);

            return response()->json($results); // Mengembalikan seluruh hasil pencarian dalam bentuk JSON
        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e->getMessage());

            // Return a response indicating an error
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function Penilaian()
    {
        $nip = session('nip');
        if (!$nip) abort(403);

        $pegawai = DB::table('pegawai')
            ->where('nip', $nip)
            ->first();
        $penilaian = DB::table('hasil_penilaian_ak')
            ->where('nip', $nip)
            ->first();

        if (!$pegawai) {
            abort(404, 'Data pegawai tidak ditemukan');
        }

        return view('lpak.penilaian', compact('pegawai', 'penilaian'));
    }

    public function proses(Request $request)
    {
        // 1. Ambil input user
        $predikat = $request->predikat_kinerja;
        $jabatan  = $request->jabatan;
        $periode = $request->periode_penilaian;
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        $pendidikan = $request->pendidikan_lebih_tinggi;
        $akLama = floatval($request->ak_lama);
        $tujuanUsulan = $request->tujuan_usulan;
        $pangkat = $request->pangkat;
        $golongan = $request->golongan;
        $nama = $request->nama;
        $nip = $request->nip;
        $jenjang = $request->jenjang;
        $penilai=$request->nama_pejabat_penilai;
        $nip_penilai=$request->nip_pejabat_penilai;
        //dd($request->all());

        Carbon::setLocale('id');

        $bulanAwal  = Carbon::parse($request->tanggal_awal)->translatedFormat('F');
        $bulanAkhir = Carbon::parse($request->tanggal_akhir)->translatedFormat('F');

        $instansi = DB::table('pegawai')
                        ->where('nip', $nip)
                        ->value('instansi'); // angka, bukan string %
        // 2. RULE KONVERSI PREDIKAT KINERJA (R1-R5)
        $persentase = DB::table('predikat_kinerja')
                        ->where('predikat', $predikat)
                        ->value('presentase'); // angka, bukan string %

        // 3. RULE KOEFISIEN JABATAN (R6-R13)
        $koefisien = DB::table('koefisien_jabatan')
                        ->where('jenjang_jabatan', $jenjang)
                        ->value('koefisien');

        // 4. RULE FAKTOR PERIODE (R14-R15)
        if ($periode === '1_tahun') {
            $faktorPeriode = DB::table('periode_penilaian')
                                ->where('kode','PP1')
                                ->value('faktor');
        } else {
            // hitung jumlah bulan / 12
            $tglAwal = new \DateTime($tanggalAwal);
            $tglAkhir = new \DateTime($tanggalAkhir);
            $diff = $tglAkhir->diff($tglAwal);
            $jumlahBulan = $diff->m + ($diff->y * 12);
            $faktorPeriode = $jumlahBulan / 12;
        }

        // 5. RULE PERHITUNGAN AK PERIODE (R16)
        $akPeriode = $persentase / 100 * $koefisien * $faktorPeriode;
        $ak_min_jenjang = DB::table('ak_jenjang_jabatan')
                        ->where('jenjang_jabatan', $jenjang)
                        ->value('ak_min_jenjang');
        // 6. RULE TAMB. AK PENDIDIKAN (R17-R19)
       $predikatLayak = in_array($predikat, ['Baik', 'Sangat Baik']);

        if ($pendidikan === 'Ya' && $predikatLayak) {
            // R17: 25% dari AK Minimal Jenjang
            $akTambahan = 0.25 * $ak_min_jenjang;
        } else {
            // R18 & R19
            $akTambahan = 0;
        }

        // 7. RULE TOTAL AK KUMULATIF (R20)
        $totalAK = $akLama+$akPeriode + $akTambahan;

        // 8. RULE EVALUASI KELAYAKAN (R21-R24)
        $akMinimal = DB::table('ak_jenjang_jabatan')
                        ->where('jenjang_jabatan', $jenjang)
                        ->value(
                            $tujuanUsulan === 'Kenaikan Pangkat' ? 'ak_min_pangkat' : 'ak_min_jenjang'
                        );

        $statusHasil = DB::table('status_kelayakan')->where('kode','H3')->value('status'); // default H3
        if ($totalAK >= $akMinimal) {
            $statusHasil = DB::table('status_kelayakan')->where('kode',
                $tujuanUsulan === 'Kenaikan Pangkat' ? 'H1' : 'H2'
            )->value('status');
        }

        // 9. RULE KHUSUS PENGANGKATAN AWAL (R25-R26)
        $paramJenjangAwal = $request->jenjang_awal ?? null; // JA1 / JA2
        $paramPangkatAwal = $request->pangkat_awal ?? null; // PA1 / PA2

        if (($paramJenjangAwal === 'JA1' && $paramPangkatAwal === 'PA1' && $totalAK >= 40) ||
            ($paramJenjangAwal === 'JA2' && $paramPangkatAwal === 'PA2' && $totalAK >= 50)
        ) {
            $statusHasil = DB::table('status_kelayakan')->where('kode','H2')->value('status');
        } // riwayat pegawai di cek, saat mengecek status hasil


        ///admin dapat melihat pdf dari yang diajukan dari pegawai, tambah riwayat pengajuan di tampilan pegawai
        //setelah di acc admin, baru pegawai dapat download pdf

        DB::beginTransaction();

        try {

               DB::table('hasil_penilaian_ak')->insert([
                // Identitas pegawai
                'nama' => $nama,
                'nip' => $nip,
                'pangkat' => $pangkat,
                'golongan' => $golongan,
                'jabatan' => $jabatan,
                'unit_kerja' => $instansi,

                // Parameter penilaian
                'predikat_kinerja' => $predikat,
                'persentase_kinerja' => $persentase,
                'koefisien_ak' => $koefisien,
                'faktor_periode' => $faktorPeriode,
                'bulan_awal' => $bulanAwal,
                'bulan_akhir' => $bulanAkhir,

                // Angka kredit
                'ak_lama' => $akLama,
                'ak_periode' => $akPeriode,
                'ak_tambahan' => $akTambahan,
                'total_ak' => $totalAK,
                'approved_by'=>$penilai,
                'nip_penilai'=>$nip_penilai,
                // Hasil
                'tujuan_usulan' => $tujuanUsulan,
                'status_hasil' => $statusHasil,
                'status_pengajuan' => 'Diajukan',
                'created_at' => now(),
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        // 10. Return / Tampilkan Hasil
        return view('lpak.hasil_penilaian', [
              // Perhitungan
            'persentase' => $persentase,
            'koefisien' => $koefisien,
            'faktorPeriode' => $faktorPeriode,
            'akPeriode' => $akPeriode,
            'akTambahan' => $akTambahan,
            'totalAK' => $totalAK,
            'statusHasil' => $statusHasil,
            'akLama'=>$akLama,
            'tujuanUsulan'=>$tujuanUsulan,

            // PARAMETER PDF
            'pegawai' => [
                'nama' => $request->nama,
                'nip' => $request->nip,
                'pangkat' => $pangkat,
                'jabatan' => $jabatan,
                'unit_kerja' => $instansi,
                'periode' => $request->periode_label,
                'golongan'=>$golongan,
                'bulan_awal' => $bulanAwal,
                'bulan_akhir' => $bulanAkhir,
            ],

            'penilaian' => [
                'predikat' => $predikat,
                'persentase' => $persentase . '%',
                'koefisien' => $koefisien,
                'faktor' => number_format($faktorPeriode, 2),
            ]
        ]);
    }
    public function cetakPdf($nip, $tahun)
    {
        $nip = session('nip');
        $current = DB::table('hasil_penilaian_ak as h')
        ->join('pegawai as p', 'p.nip', '=', 'h.nip')
        ->where('h.nip', $nip)
        ->whereYear('h.created_at', $tahun)
        ->select('h.*', 'p.nama', 'p.tempat_lahir', 'p.tanggal_lahir',
                 'p.jenis_kelamin', 'p.pangkat', 'p.golongan',
                 'p.tmt_pangkat', 'p.jabatan', 'p.tmt_jabatan',
                 'p.unit_kerja', 'p.instansi', 'p.nomor_kartu')
        ->first();

    if (!$current) abort(404, 'Data tidak ditemukan');

    // 🔹 RIWAYAT SEBELUMNYA (HANYA YANG DISETUJUI)
    $riwayat = DB::table('hasil_penilaian_ak')
        ->where('nip', $nip)
        ->where('status_pengajuan', 'Disetujui')
        ->whereYear('created_at', '<', $tahun)
        ->orderBy('created_at', 'asc')
        ->get();

    $pdf = Pdf::loadView('lpak.pak', [
        'data'     => $current,
        'riwayat'  => $riwayat,
        'tahun'    => $tahun
    ])->setPaper('A4', 'portrait');

        return $pdf->stream("PAK_{$nip}_{$tahun}.pdf");
    }

    public function riwayatPengajuan(Request $request)
    {
        // jika role pegawai → pakai NIP login
        $nip = session('nip');
        //dd($nip);
        $riwayat = DB::table('hasil_penilaian_ak')
            ->where('nip', $nip)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('lpak.riwayat', [
            'riwayat' => $riwayat
        ]);
    }
    public function previewPdf($tahun)
    {
        $nip = session('nip');

        $current = DB::table('hasil_penilaian_ak as h')
        ->join('pegawai as p', 'p.nip', '=', 'h.nip')
        ->where('h.nip', $nip)
        ->whereYear('h.created_at', $tahun)
        ->select('h.*', 'p.nama', 'p.tempat_lahir', 'p.tanggal_lahir',
                 'p.jenis_kelamin', 'p.pangkat', 'p.golongan',
                 'p.tmt_pangkat', 'p.jabatan', 'p.tmt_jabatan',
                 'p.unit_kerja', 'p.instansi', 'p.nomor_kartu')
        ->first();

        if (!$current) abort(404, 'Data tidak ditemukan');

        // 🔹 RIWAYAT SEBELUMNYA (HANYA YANG DISETUJUI)
        $riwayat = DB::table('hasil_penilaian_ak')
            ->where('nip', $nip)
            ->where('status_pengajuan', 'Disetujui')
            ->whereYear('created_at', '<', $tahun)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($riwayat);
        $jenjang = DB::table('ak_jenjang_jabatan as h')
            ->join('pegawai as p', 'p.jenjang', '=', 'h.jenjang_jabatan')
            ->where('p.nip', $nip)
            ->select('h.*')
            ->first();
        //dd($riwayat);
        $pdf = Pdf::loadView('lpak.pak', [
            'data'     => $current,
            'riwayat'  => $riwayat,
            'tahun'    => $tahun,
            'jenjang'  => $jenjang,
            'mode'     => 'preview'
        ])->setPaper('A4', 'portrait');

        // STREAM = preview (tidak download)
        return $pdf->stream("PREVIEW_PAK_{$nip}_{$tahun}.pdf");
    }
    public function previewPdfAdmin($nip,$tahun)
    {
        
        $current = DB::table('hasil_penilaian_ak as h')
        ->join('pegawai as p', 'p.nip', '=', 'h.nip')
        ->where('h.nip', $nip)
        ->whereYear('h.created_at', $tahun)
        ->select('h.*', 'p.nama', 'p.tempat_lahir', 'p.tanggal_lahir',
                 'p.jenis_kelamin', 'p.pangkat', 'p.golongan',
                 'p.tmt_pangkat', 'p.jabatan', 'p.tmt_jabatan',
                 'p.unit_kerja', 'p.instansi', 'p.nomor_kartu')
        ->first();

        if (!$current) abort(404, 'Data tidak ditemukan');

        // 🔹 RIWAYAT SEBELUMNYA (HANYA YANG DISETUJUI)
        $riwayat = DB::table('hasil_penilaian_ak')
            ->where('nip', $nip)
            ->where('status_pengajuan', 'Disetujui')
            ->whereYear('created_at', '<', $tahun)
            ->orderBy('created_at', 'asc')
            ->get();
        //dd($riwayat);
        $jenjang = DB::table('ak_jenjang_jabatan as h')
            ->join('pegawai as p', 'p.pangkat', '=', 'h.jenjang_jabatan')
            ->where('p.nip', $nip)
            ->select('h.*')
            ->first();
        //dd($riwayat);
        $pdf = Pdf::loadView('lpak.pak', [
            'data'     => $current,
            'riwayat'  => $riwayat,
            'tahun'    => $tahun,
            'jenjang'  => $jenjang,
            'mode'     => 'preview'
        ])->setPaper('A4', 'portrait');

        // STREAM = preview (tidak download)
        return $pdf->stream("PREVIEW_PAK_{$nip}_{$tahun}.pdf");
    }
    public function viewPAK(Request $request)
    {

        $riwayat = DB::table('hasil_penilaian_ak as h')
        ->join('pegawai as p', 'p.nip', '=', 'h.nip')
        ->select('h.*', 'p.nama', 'p.nip')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('approve', [
            'riwayat' => $riwayat
        ]);
    }
    public function approve($id)
    {
        if (!session('is_admin')) abort(403);

        DB::beginTransaction();

        try {
            $pak = DB::table('hasil_penilaian_ak')->where('id', $id)->first();
            if (!$pak) abort(404);

            $pegawai = DB::table('pegawai')->where('nip', $pak->nip)->first();
            if (!$pegawai) abort(404);

            // 🔴 AMBIL AK MINIMAL SESUAI TUJUAN
            $akMinimal = DB::table('ak_jenjang_jabatan')
                ->where('jenjang_jabatan', $pegawai->jabatan)
                ->value(
                    $pak->tujuan_usulan === 'Kenaikan Pangkat'
                        ? 'ak_min_pangkat'
                        : 'ak_min_jenjang'
                );

            // 🔴 CEK KELAYAKAN AK
            $layakNaik = $pak->total_ak >= $akMinimal;

            // 🔹 UPDATE STATUS PAK (SELALU)
            DB::table('hasil_penilaian_ak')
                ->where('id', $id)
                ->update([
                    'status_pengajuan' => 'Disetujui',
                    'approved_at' => now()
                ]);

            // ❌ JIKA TIDAK LAYAK → STOP
            if (!$layakNaik) {
                DB::commit();
                return back()->with('warning', 'Disetujui secara administratif, tetapi AK belum memenuhi syarat kenaikan.');
            }

            // ✅ SIMPAN RIWAYAT (DATA LAMA)
            DB::table('riwayat_jabatan_pangkat')->insert([
                'nip' => $pegawai->nip,
                'pangkat_lama' => $pegawai->pangkat,
                'golongan_lama' => $pegawai->golongan,
                'jabatan_lama' => $pegawai->jabatan,
                'tmt_pangkat_lama' => $pegawai->tmt_pangkat,
                'tmt_jabatan_lama' => $pegawai->tmt_jabatan,
                'jenis_usulan' => $pak->tujuan_usulan,
                'pak_id' => $pak->id,
                'disetujui_pada' => now(),
            ]);

            // ✅ UPDATE PEGAWAI
            $update = [];

            if ($pak->tujuan_usulan === 'Kenaikan Pangkat') {
                $update['pangkat'] = $pak->pangkat;
                $update['golongan'] = $pak->golongan;
                $update['tmt_pangkat'] = now();
            }

            if ($pak->tujuan_usulan === 'Kenaikan Jabatan') {
                $update['jabatan'] = $pak->jabatan;
                $update['tmt_jabatan'] = now();
            }

            DB::table('pegawai')->where('nip', $pegawai->nip)->update($update);

            DB::commit();
            return back()->with('success', 'Pengajuan disetujui dan kenaikan diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function reject(Request $request, $id)
    {
        if (!session('is_admin')) {
            abort(403);
        }

        $request->validate([
            'alasan_ditolak' => 'required|string|min:5'
        ]);

        DB::table('hasil_penilaian_ak')
            ->where('id', $id)
            ->update([
                'status_pengajuan' => 'Ditolak',
                'alasan'   => $request->alasan_ditolak,
                'approved_at'       => now()
            ]);

        return back()->with('success', 'Pengajuan berhasil ditolak');
    }


}
