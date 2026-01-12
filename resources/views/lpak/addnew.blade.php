@extends('admin.dashboard')

@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="page-content">
    <div class="card">
        <div class="card-body">

            <h4 class="mb-4 text-center">
                MENAMBAH PEGAWAI BARU
            </h4>

            <form method="POST" action="{{ route('pegawai.store') }}">
                @csrf

                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Nomor Kartu ASN</label>
                        <input type="text" name="no_kartu_asn" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tempat</label>
                        <input type="text" name="tempatlahir" class="form-control"
                               placeholder="KARO">
                    </div>
                    <div class="col-md-4">
                        <label  for="tanggallahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" id ="tanggallahir" name="tanggallahir" class="form-control" placeholder="01-01-1990">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <select name="pendidikan" class="form-control">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SMA/SMK">SMA / SMK</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Instansi Pendidikan</label>
                        <input type="text" name="instansipendidikan" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="prodi" class="form-control"
                              >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Pangkat</label>
                        <input type="text" name="pangkat" class="form-control"
                            placeholder="Pengatur">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Golongan</label>
                        <input type="text" name="golongan" class="form-control"
                            placeholder="II/c">
                    </div>

                    <div class="col-md-4">
                        <label for="tmt_pangkat" class="form-label" >TMT Pangkat</label>
                        <input type="date" id ="tmt_pangkat" name="tmt_pangkat" class="form-control" placeholder="01-01-2020">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control"
                            placeholder="Pranata Komputer Terampil">
                    </div>

                    <div class="col-md-6">
                        <label for="tmt_jabatan" class="form-label">TMT Jabatan</label>
                        <input type="date" class="form-control" id="tmt_jabatan" name="tmt_jabatan" class="form-control"
                        placeholder="01-01-2020">
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Unit Kerja</label>
                        <input type="text" name="unit_kerja" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instansi</label>
                        <input type="text" name="instansi" class="form-control"
                               value="Pemerintah Provinsi Sumatera Utara" readonly>
                    </div>
                </div>

                <hr>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Hitung Angka Kredit --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr('#tanggallahir', {
            dateFormat: 'd-m-Y'
        });
        flatpickr('#tmt_pangkat', {
            dateFormat: 'd-m-Y'
        });
        flatpickr('#tmt_jabatan', {
            dateFormat: 'd-m-Y'
        });
    });
</script>
@endsection
