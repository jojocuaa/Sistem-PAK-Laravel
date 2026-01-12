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
                            Belum ada Pengajuan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Pengaju</th>
                                        <th>NIP</th>
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
                                            <td class="text-center">{{ strtoupper($row->nama) }}</td>
                                            
                                            <td class="text-center">{{ $row->nip}}</td>
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
                                                {{-- Preview tetap ada --}}
                                                <a href="{{ route('pak.pdf.preview.admin', [
                                                    'nip'   => $row->nip,
                                                    'tahun' => \Carbon\Carbon::parse($row->created_at)->year
                                                ]) }}"
                                                class="btn btn-sm btn-outline-primary mb-1"
                                                target="_blank">
                                                    👁 Preview
                                                </a>


                                                {{-- Aksi admin --}}
                                                @if($row->status_pengajuan === 'Diajukan')
                                                    <form action="{{ route('pak.approve', $row->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success"
                                                            onclick="return confirm('Setujui pengajuan ini?')">
                                                            ✔ Setujui
                                                        </button>
                                                    </form>

                                                    <button class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalReject{{ $row->id }}">
                                                        ✖ Tolak
                                                    </button>

                                                @endif
                                            </td>
                                            <div class="modal fade" id="modalReject{{ $row->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('pak.reject', $row->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Alasan ditolak <span class="text-danger">*</span></label>
                                                    <textarea name="alasan_ditolak"
                                                            class="form-control"
                                                            rows="4"
                                                            required
                                                            placeholder="Masukkan alasan penolakan..."></textarea>
                                                </div>
                                                </div>

                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    ✖ Tolak Pengajuan
                                                </button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>

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
