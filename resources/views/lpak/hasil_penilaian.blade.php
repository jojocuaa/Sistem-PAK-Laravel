@extends('admin.dashboard')

@section('admin')
<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="mt-4">👤 Data Pegawai</h5>
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{ $pegawai['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $pegawai['nip'] }}</td>
                        </tr>
                        <tr>
                            <th>Pangkat / Golongan</th>
                            <td>{{ $pegawai['pangkat'] }} / {{ $pegawai['golongan'] }}</td>
                        </tr>

                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $pegawai['jabatan'] }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>{{ $pegawai['unit_kerja'] }}</td>
                        </tr>
                        <tr>
                            <th>Periode Penilaian</th>
                            <td>{{ $pegawai['bulan_awal'] }} - {{ $pegawai['bulan_akhir'] }}</td>
                        </tr>
                    </table>
                    <h5 class="mt-4">📑 Parameter Penilaian</h5>
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Predikat</th>
                                <th>Persentase</th>
                                <th>Koefisien / Tahun</th>
                                <th>Faktor Periode</th>
                                <th>AK Periode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $penilaian['predikat'] }}</td>
                                <td>{{ $penilaian['persentase'] }}</td>
                                <td>{{ $penilaian['koefisien'] }}</td>
                                <td>{{ $penilaian['faktor'] }}</td>
                                <td class="fw-bold text-success">
                                    {{ number_format($akPeriode, 3) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="mt-4">📊 Akumulasi Angka Kredit</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">AK Lama</th>
                            <td>{{ number_format($akLama ?? 0, 3, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>AK Periode</th>
                            <td>{{ number_format($akPeriode, 3, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>AK Tambahan Pendidikan</th>
                            <td>{{ number_format($akTambahan, 3, ',', '.') }}</td>
                        </tr>
                        <tr class="table-primary">
                            <th>Total AK Kumulatif</th>
                            <td class="fw-bold fs-5">
                                {{ number_format($totalAK, 3, ',', '.') }}
                            </td>
                        </tr>
                    </table>


                    <hr>

                    {{-- Tombol Aksi --}}
                    <div class="text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            ⬅ Kembali
                        </a>

                    <a href="{{ route('pak.pdf', [$pegawai['nip'], date('Y')]) }}"
                    class="btn btn-danger">
                        📄 Preview PDF PAK
                    </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
