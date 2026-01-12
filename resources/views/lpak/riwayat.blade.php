@extends('admin.dashboard')

@section('admin')
<div class="page-content">

    <div class="row justify-content-center">
        <div class="col-md-11">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="mb-4">
                        📑 Riwayat Pengajuan Penilaian Angka Kredit
                    </h4>

                    @if($riwayat->isEmpty())
                        <div class="alert alert-info">
                            Belum ada riwayat pengajuan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Predikat</th>
                                        <th>Total AK</th>
                                        <th>Tujuan Usulan</th>
                                        <th>Status Sistem</th>
                                        <th>Status Pengajuan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $index => $row)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>

                                            <td class="text-center">
                                                {{ $row->bulan_awal }} – {{ $row->bulan_akhir }}
                                                <br>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($row->created_at)->year }}
                                                </small>
                                            </td>

                                            <td class="text-center">
                                                {{ $row->predikat_kinerja }}
                                            </td>

                                            <td class="text-end fw-bold">
                                                {{ number_format($row->total_ak, 2, ',', '.') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $row->tujuan_usulan }}
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                    {{ $row->status_hasil }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                @if($row->status_pengajuan === 'Disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($row->status_pengajuan === 'Ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Diajukan</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d F Y') }}
                                            </td>

                                            <td class="text-center">
                                                    <a href="{{ route('pak.pdf.preview', \Carbon\Carbon::parse($row->created_at)->year) }}"
                                                    class="btn btn-sm btn-outline-primary"
                                                    target="_blank">
                                                        👁 Preview
                                                    </a>
                                                <a href="{{ route('pak.pdf', [$row->nip, \Carbon\Carbon::parse($row->created_at)->year]) }}"
                                                   class="btn btn-sm btn-danger
                                                   {{ $row->status_pengajuan !== 'Disetujui' ? 'disabled' : '' }}">
                                                    📄 PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
