<!-- tabel harus tersambung tidak tersimpan-->
<style>
@page {
    margin: 5cm 2.5cm 2.5cm 2.5cm;
}

/* HEADER GLOBAL */
.header {
    position: fixed;
    top: -3.6cm;
    left: 0;
    right: 0;
    height: 2.8cm;
    text-align: center;
}

.header img {
    height: 100px;
}

.header .title {
    font-family: "Times New Roman", serif;
    font-size: 18px;   /* ← BESARKAN DI SINI */
    font-weight: bold;
    margin-top: 6px;
    letter-spacing: 0.5px; /* opsional, biar lebih tegas */
}


.header .line {
    border-top: 2px solid #000;
    margin-top: 6px;
}

/* BODY */
body {
    font-family: "Times New Roman", serif;
    font-size: 12px;
}

.page-break {
    page-break-before: always;
    break-before: page;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td, th {
    border: 1px solid #000;
    padding: 4px;
}

.no-border td {
    border: none;
}

.gray {
    background: #d9d9d9;
}

.center { text-align: center; }
.bold { font-weight: bold; }
</style>
@php
    function U($value) {
        return $value ? strtoupper($value) : '-';
    }
    $totalAk = 0;
    $totalPeriode = 0;
    $akMinPangkat  = $jenjang->ak_min_pangkat ?? 0;
    $akMinJenjang  = $jenjang->ak_min_jenjang ?? 0;

    //dd($kelebihanPangkat, $kekuranganJenjang);
    $kelebihanPangkat  = null;
    $kekuranganPangkat = null;

    if ($totalAk >= $akMinPangkat) {
        $kelebihanPangkat = ($data->total_ak ?? 0) - $akMinPangkat;
    } else {
        $kekuranganPangkat = $akMinPangkat - ($data->total_ak ?? 0);
    }
    $kelebihanJenjang  = null;
    $kekuranganJenjang = null;

    if ($totalAk >= $akMinJenjang) {
        $kelebihanJenjang = ($data->total_ak ?? 0) - $akMinJenjang;
    } else {
        $kekuranganJenjang = $akMinJenjang - ($data->total_ak ?? 0);
    }
    //dd($kelebihanPangkat, $kekuranganJenjang);
@endphp

<div class="header">
    <img src="{{ public_path('assets/images/logo2.png') }}" alt="Logo Provsu" width="200">
    <div class="title">PEMERINTAH PROVINSI SUMATERA UTARA</div><
    <div class="line"></div>
</div>


<div class="center">
    KONVERSI PREDIKAT KINERJA KE ANGKA KREDIT
</div>

<div class="center mt-1">
    NOMOR: ..............................
</div>

<table width="100%" style="border-collapse:collapse; margin-top:10px;">
    {{-- HEADER INFO --}}
    <tr class="no-border">
        <td colspan="2">Instansi: Pemerintah Provinsi Sumatera Utara</td>
        <td colspan="2" class="right">Periode: {{ $data->bulan_awal }} - {{$data->bulan_akhir}} 
            {{ \Carbon\Carbon::parse($data->created_at)->year }}</td>
    </tr>

    {{-- SPASI --}}
    <tr class="no-border">
        <td colspan="4" style="height:10px;"></td>
    </tr>

    {{-- JUDUL 1 --}}
    <tr>
        <th colspan="4" class="center">PEJABAT FUNGSIONAL YANG DINILAI</th>
    </tr>

    <tr>
        <td width="5%">1</td><td width="30%">Nama</td><td width="5%">:</td>
        <td>{{ U($data->nama) }}</td>
    </tr>
    <tr>
        <td>2</td><td>NIP</td><td>:</td><td>{{ $data->nip }}</td>
    </tr>
    <tr>
        <td>3</td><td>Nomor Kartu ASN</td><td>:</td>
        <td>{{ $data->nomor_kartu ?? '-' }}</td>
    </tr>
    <tr>
        <td>4</td><td>Tempat/Tgl. Lahir</td><td>:</td>
        <td>
            {{ U($data->tempat_lahir) }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>5</td><td>Jenis Kelamin</td><td>:</td>
        <td>{{ U($data->jenis_kelamin) }}</td>
    </tr>
    <tr>
        <td>6</td><td>Pangkat/Golongan Ruang/TMT</td><td>:</td>
        <td>
            {{ U($data->pangkat) }} / {{ U($data->golongan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_pangkat)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>7</td><td>Jabatan/TMT</td><td>:</td>
        <td>
            {{ U($data->jabatan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_jabatan)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>8</td><td>Unit Kerja</td><td>:</td>
        <td>{{ U($data->unit_kerja) }}</td>
    </tr>
    <tr>
        <td>9</td><td>Instansi</td><td>:</td>
        <td>{{ U($data->instansi) }}</td>
    </tr>

    {{-- JUDUL 2 --}}
    <tr>
        <th colspan="4" class="center">
            KONVERSI PREDIKAT KINERJA KE ANGKA KREDIT
        </th>
    </tr>

    <tr class="center">
        <th colspan="2">Hasil Penilaian Kinerja</th>
        <th rowspan="2">Koefisien<br>per tahun</th>
        <th rowspan="2">Angka Kredit yang didapat<br>(Kolom 2 × Kolom 3)</th>
    </tr>
    <tr class="center">
        <th>Predikat</th>
        <th>Prosentase</th>
    </tr>

    <tr class="gray center">
        <td>1</td><td>2</td><td>3</td><td>4</td>
    </tr>

    <tr class="center">
        <td>{{ U($data->predikat_kinerja) }}</td>
        <td>150 %</td>
        <td>{{ $data->koefisien_ak }}</td>
        <td>7,5</td>
    </tr>
</table>


<table width="100%" class="no-border" style="margin-top:30px;">
    <tr>
        <td width="50%"></td>
        <td width="50%" align="right">
            <div>
                Ditetapkan di Medan<br>
                Pada tanggal ..............................<br><br>

                Pejabat Penilai Kinerja<br><br><br>

                <span class="underline"> <b>{{ U($data->approved_by)}}</b></span><br>
                NIP. {{ U($data->nip_penilai)}}
            </div>
        </td>
    </tr>
</table>
<p class="mt-3">
<b>Tembusan disampaikan kepada:</b><br>
1. Kepala Perangkat Daerah yang bersangkutan;<br>
2. Pejabat Penilai Kinerja;<br>
3. Sekretaris Tim Penilai yang bersangkutan; dan<br>
4. Kepala Badan Kepegawaian Provsu.
</p>

<div class="page-break"></div>
<div class="center bold">
    PEMERINTAH PROVINSI SUMATERA UTARA
</div>
<div class="line"></div>

<div class="center bold">
    AKUMULASI ANGKA KREDIT
</div>

<div class="center mt-1">
    NOMOR: ..............................
</div>

<table width="100%" style="border-collapse:collapse; margin-top:10px;">
    {{-- HEADER --}}
    <tr class="no-border">
        <td colspan="3">Instansi: Pemerintah Provinsi Sumatera Utara</td>
        <td colspan="3" class="right">Masa Penilaian: {{ $data->bulan_awal }} - {{$data->bulan_akhir}} 
            {{ \Carbon\Carbon::parse($data->created_at)->year }}</td>
    </tr>
    {{-- SPASI --}}
    <tr class="no-border">
        <td colspan="6" style="height:10px;"></td>
    </tr>

    {{-- JUDUL I --}}
    <tr>
        <th colspan="6" class="left">I. KETERANGAN PERORANGAN</th>
    </tr>

    <tr>
        <td width="5%">1</td>
        <td width="30%">Nama</td>
        <td width="5%">:</td>
        <td colspan="3">{{ U($data->nama) }}</td>
    </tr>
    <tr>
        <td>2</td><td>NIP</td><td>:</td>
        <td colspan="3">{{ $data->nip }}</td>
    </tr>
    <tr>
        <td>3</td><td>Nomor Seri KARPEG</td><td>:</td>
        <td colspan="3">{{ $data->nomor_kartu }}</td>
    </tr>
    <tr>
        <td>4</td><td>Tempat/Tgl. Lahir</td><td>:</td>
        <td colspan="3">
            {{ U($data->tempat_lahir) }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>5</td><td>Jenis Kelamin</td><td>:</td>
        <td colspan="3">{{ U($data->jenis_kelamin) }}</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Pangkat/Golongan Ruang/TMT</td>
        <td>:</td>
        <td colspan="3">
            {{ U($data->pangkat) }} / {{ U($data->golongan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_pangkat)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>7</td><td>Jabatan/TMT</td><td>:</td>
        <td colspan="3">
            {{ U($data->jabatan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_jabatan)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>8</td><td>Unit Kerja</td><td>:</td>
        <td colspan="3">{{ U($data->unit_kerja) }}</td>
    </tr>

    {{-- JUDUL II --}}
    <tr>
        <th colspan="6" class="center">HASIL PENILAIAN ANGKA KREDIT</th>
    </tr>

    <tr class="center">
        <th>TAHUN</th>
        <th>PERIODIK (BULAN)</th>
        <th>PREDIKAT</th>
        <th>PROSENTASE</th>
        <th>KOEFISIEN<br>PER TAHUN</th>
        <th>ANGKA KREDIT<br>YANG DIDAPAT</th>
    </tr>

    <tr class="gray center">
        <td>1</td><td>2</td><td>3</td>
        <td>4</td><td>5</td><td>6</td>
    </tr>

    {{-- RIWAYAT --}}
    @if($riwayat->isNotEmpty())
        @foreach ($riwayat as $r)
            @php $totalAk += $r->ak_periode; @endphp
            <tr class="center">
                <td>{{ \Carbon\Carbon::parse($r->created_at)->year }}</td>
                <td>{{ $r->bulan_awal }} – {{ $r->bulan_akhir }}</td>
                <td>{{ U($r->predikat_kinerja) }}</td>
                <td>{{ $r->persentase_kinerja ? $r->persentase_kinerja.' %' : '-' }}</td>
                <td>{{ U($r->koefisien_ak) }}</td>
                <td>{{ number_format($r->ak_periode, 3, ',', '.') }}</td>
            </tr>
        @endforeach
    @endif

    {{-- TAHUN BERJALAN --}}
    @php $totalAk += $data->total_ak; @endphp
    @php $totalPeriode += $data->ak_periode; @endphp
    <tr class="center bold">
        <td>{{ $tahun }}</td>
        <td>{{ $data->bulan_awal }} – {{ $data->bulan_akhir }}</td>
        <td>{{ U($data->predikat_kinerja) }}</td>
        <td>{{ $data->persentase_kinerja }} %</td>
        <td>{{ $data->koefisien_ak }}</td>
        <td>{{ number_format($data->ak_periode, 3, ',', '.') }}</td>
    </tr>

    {{-- TOTAL --}}
    <tr class="bold">
        <td colspan="5" class="center">
            JUMLAH ANGKA KREDIT YANG DIPEROLEH
        </td>
        <td class="center">
            {{ number_format($totalPeriode, 3, ',', '.') }}
        </td>
    </tr>
</table>


<table width="100%" class="no-border" style="margin-top:30px;">
    <tr>
        <td width="50%"></td>
        <td width="50%" align="right">
            <div>
                Ditetapkan di Medan<br>
                Pada tanggal ..............................<br><br>

                Pejabat Penilai Kinerja<br><br><br>

                <span class="underline"> <b>{{ U($data->approved_by)}}</b></span><br>
                NIP. {{ U($data->nip_penilai)}}
            </div>
        </td>
    </tr>
</table>

<p class="mt-3">
<b>Tembusan disampaikan kepada:</b><br>
1. Kepala Perangkat Daerah yang bersangkutan;<br>
2. Pejabat Penilai Kinerja;<br>
3. Sekretaris Tim Penilai yang bersangkutan; dan<br>
4. Kepala Badan Kepegawaian Provsu.
</p>

<div class="page-break"></div>


<div class="center bold">
    PENETAPAN ANGKA KREDIT
</div>

<div class="center mt-1">
    NOMOR : ..................................
</div>

<table class="no-border mt-2">
    <tr class="no-border">
        <td colspan="3">Instansi: Pemerintah Provinsi Sumatera Utara</td>
        <td colspan="3" class="right">Masa Penilaian: {{ $data->bulan_awal }} - {{$data->bulan_akhir}} 
            {{ \Carbon\Carbon::parse($data->created_at)->year }}</td>
    </tr>
</table>

<table width="100%" style="border-collapse:collapse; margin-top:10px;">

    {{-- ===================== --}}
    {{-- I. KETERANGAN PERORANGAN --}}
    {{-- ===================== --}}
    <tr>
        <th colspan="6" class="left">I&nbsp;&nbsp;KETERANGAN PERORANGAN</th>
    </tr>

    <tr>
        <td width="5%">1</td>
        <td width="45%">Nama</td>
        <td colspan="4">{{ U($data->nama) }}</td>
    </tr>
    <tr>
        <td>2</td><td>NIP</td>
        <td colspan="4">{{ $data->nip }}</td>
    </tr>
    <tr>
        <td>3</td><td>Nomor Kartu ASN</td>
        <td colspan="4">{{ $data->nomor_kartu }}</td>
    </tr>
    <tr>
        <td>4</td><td>Tempat/Tgl. Lahir</td>
        <td colspan="4">
            {{ U($data->tempat_lahir) }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>5</td><td>Jenis Kelamin</td>
        <td colspan="4">{{ U($data->jenis_kelamin) }}</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Pangkat/Golongan Ruang/TMT</td>
        <td colspan="4">
            {{ U($data->pangkat) }} / {{ U($data->golongan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_pangkat)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>7</td><td>Jabatan/TMT</td>
        <td colspan="4">
            {{ U($data->jabatan) }} /
            {{ \Carbon\Carbon::parse($data->tmt_jabatan)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td>8</td><td>Unit Kerja</td>
        <td colspan="4">{{ U($data->unit_kerja) }}</td>
    </tr>

    {{-- ===================== --}}
    {{-- II. PENETAPAN ANGKA KREDIT --}}
    {{-- ===================== --}}
    <tr>
        <th width="5%">II</th>
        <th colspan="5" class="left">PENETAPAN ANGKA KREDIT</th>
    </tr>

    <tr class="center">
        <th>No</th>
        <th>Uraian</th>
        <th>Lama</th>
        <th>Baru</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>

    <tr class="gray center">
        <td>1</td><td>2</td><td>3</td>
        <td>4</td><td>5</td><td>6</td>
    </tr>

    {{-- 1 --}}
    <tr>
        <td class="center">1</td>
        <td>AK Dasar yang diberikan</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td>&nbsp;</td>
    </tr>

    {{-- 2 --}}
    <tr>
        <td class="center">2</td>
        <td>AK JF lama</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td>&nbsp;</td>
    </tr>

    {{-- 3 --}}
    <tr>
        <td class="center">3</td>
        <td>AK Penyesuaian / Penyetaraan</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td>&nbsp;</td>
    </tr>

    {{-- 4 --}}
    <tr>
        <td class="center">4</td>
        <td>AK Konversi</td>

        {{-- Lama --}}
        <td class="center">
            {!! isset($r) && $r->total_ak !== null
                ? number_format($r->ak_periode, 3, ',', '.')
                : '-' !!}
        </td>

        {{-- Baru --}}
        <td class="center">
            {{ number_format($data->ak_periode, 3, ',', '.') }}
        </td>

        {{-- Jumlah --}}
        <td class="center">
            {{ number_format($data->ak_periode, 3, ',', '.') }}
        </td>

        <td>&nbsp;</td>
    </tr>

    {{-- 5 --}}
    <tr>
        <td class="center">5</td>
        <td>AK yang diperoleh dari peningkatan Pendidikan</td>
        <td class="center">-</td>
        <td class="center">  {{ number_format($data->ak_tambahan, 3, ',', '.') }}</td>
        <td class="center">{{ number_format($data->ak_tambahan, 3, ',', '.') }}</td>
        <td>&nbsp;</td>
    </tr>

    {{-- 6 --}}
    <tr>
        <td class="center">6</td>
        <td>Lainnya…</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td class="center">-</td>
        <td>&nbsp;</td>
    </tr>

    {{-- TOTAL --}}
    <tr class="bold">
        <td colspan="2" class="center">JUMLAH ANGKA KREDIT KUMULATIF</td>

        <td class="center">-</td>

        <td class="center">
           {{ number_format($data->total_ak, 3, ',', '.') }}
        </td>

        <td class="center">
            {{ number_format($data->total_ak, 3, ',', '.') }}
        </td>

        <td>&nbsp;</td>

    <tr class="center bold">
        <th colspan="2">Keterangan</th>
        <th colspan="2">Pangkat</th>
        <th colspan="2">Jenjang Jabatan</th>
    </tr>


    {{-- AK MINIMAL --}}
    <tr>
        <td colspan="2">
            Angka Kredit Minimal yang harus dipenuhi untuk
            kenaikan pangkat/jenjang
        </td>
        <td colspan="2" class="center">
            {{ number_format($jenjang->ak_min_pangkat, 0, ',', '.') }}
        </td>
        <td colspan="2" class="center">
            {{ number_format($jenjang->ak_min_jenjang, 0, ',', '.') }}
        </td>
    </tr>


    {{-- KELEBIHAN --}}
    <tr>
        <td colspan="2">
            Kelebihan Angka Kredit yang harus dicapai untuk
            kenaikan pangkat
        </td>

        {{-- KOLOM PANGKAT --}}
        <td colspan="2" class="center">
            {{ $kelebihanPangkat !== null
                ? number_format($kelebihanPangkat, 3, ',', '.')
                : '-' }}
        </td>

        {{-- KOLOM JENJANG --}}
        <td colspan="2" class="center">
            {{ $kelebihanJenjang !== null
                ? number_format($kelebihanJenjang, 3, ',', '.')
                : '-' }}
        </td>
    </tr>

    {{-- KEKURANGAN --}}
    <tr>
        <td colspan="2">
            Kekurangan Angka Kredit yang harus dicapai
            untuk kenaikan jenjang
        </td>

        {{-- KOLOM PANGKAT --}}
        <td colspan="2" class="center">
            {{ $kekuranganPangkat !== null
                ? number_format($kekuranganPangkat, 3, ',', '.')
                : '-' }}
        </td>

        {{-- KOLOM JENJANG --}}
        <td colspan="2" class="center">
            {{ $kekuranganJenjang !== null
                ? number_format($kekuranganJenjang, 3, ',', '.')
                : '-' }}
        </td>
    </tr>

    <tr class="bold">
            <td colspan="6" class="center">{{U($data->status_hasil)}}</td>
           
    </tr>
</table>

<table class="no-border" style="margin-top:20px;">
<tr>
    <!-- KIRI -->
    <td width="55%" valign="top">
        <p>
            <b>ASLI</b> Penetapan Angka Kredit untuk:<br>
            Jabatan Fungsional yang bersangkutan
        </p>

        <p style="margin-top:20px;">
            <b>Tembusan disampaikan kepada:</b><br>
            1. Kepala Perangkat Daerah yang bersangkutan;<br>
            2. Pejabat Penilai Kinerja;<br>
            3. Sekretaris Tim Penilai yang bersangkutan dan<br>
            4. Kepala Badan Kepegawaian Provsu
        </p>
    </td>

    <!-- KANAN -->
    <td width="45%" valign="top" style="padding-left:30px;">
        <p>
            Ditetapkan di Medan<br>
            Pada tanggal 3 Januari 2025<br>
            Pejabat Penilai Kinerja
        </p>

        <div style="height:60px;"></div>
        <p>
            <b>{{ U($data->approved_by)}}</b><br>
            {{ U($data->nip_penilai)}}
        </p>
    </td>
</tr>
</table>
