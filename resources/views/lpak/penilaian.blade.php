@extends('admin.dashboard')

@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="page-content">
    <div class="card">
        <div class="card-body">

            <h4 class="mb-4 text-primary">
                Input Penilaian Angka Kredit
            </h4>
            <hr>
            <form method="POST" action="{{ route('proses') }}">
                @csrf
                 <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ strtoupper($pegawai->nama) }}" readonly>

                    </div>
                    <div class="col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip"
                        value="{{ $pegawai->NIP }}" readonly>
                    </div>
                </div>
                {{-- DATA PENILAIAN --}}
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Predikat Kinerja</label>
                        <select name="predikat_kinerja" class="form-control">
                            <option value="">-- pilih --</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                        <div class="col-md-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control"
                            value="{{ $pegawai->jabatan }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenjang Jabatan Fungsional</label>
                        <input type="text" name="pangkat" class="form-control"
                            value="{{ $pegawai->pangkat }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="tmt_jabatan" class="form-label">TMT Jabatan</label>
                        <input type="date" name="tmt_jabatan" class="form-control"
                            value="{{ $pegawai->tmt_jabatan }}" readonly>

                    </div>
                </div>
                      
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Riwayat Jenjang</label>
                        <input type="text" name="jenjang" class="form-control"
                            value="{{ $pegawai->jenjang }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Golongan</label>
                        <input type="text" name="golongan" class="form-control"
                            value="{{ $pegawai->golongan }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">TMT Pangkat</label>
                        <input type="date" name="tmt_pangkat" class="form-control"
                            value="{{ $pegawai->tmt_pangkat }}" readonly>
                    </div>
                     
                </div>
               <div class="row mb-4 align-items-end">
                    <!-- Periode -->
                    <div class="col-md-4">
                        <label class="form-label">Periode Penilaian</label>
                        <select name="periode_penilaian" id="periode_penilaian" class="form-control">
                            <option value="">-- pilih --</option>
                            <option value="6_bulan">6 Bulan</option>
                            <option value="1_tahun">1 Tahun</option>
                        </select>
                    </div>

                    <!-- Range Tanggal -->
                    <div class="col-md-8 d-none" id="range_tanggal">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Pendidikan Lebih Tinggi</label>
                        <select name="pendidikan_lebih_tinggi" class="form-control">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Angka Kredit Saat Ini (AK Lama)</label>
                         <input type="float" name="total_ak" class="form-control"
                           value="{{ $penilaian->total_ak ?? '' }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tujuan Usulan</label>
                        <select name="tujuan_usulan" class="form-control">
                            <option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
                            <option value="Kenaikan Jabatan">Kenaikan Jabatan</option>
                        </select>
                    </div>
                </div>

                <hr>

                {{-- DATA DRAFT PAK --}}
                {{-- <h5 class="mb-3">Data Draft PAK</h5>--}}

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pejabat Penilai</label>
                        <input type="text" name="nama_pejabat_penilai" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NIP Pejabat Penilai</label>
                        <input type="text" name="nip_pejabat_penilai" class="form-control">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Proses Penilaian
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />                    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const periode = document.getElementById('periode_penilaian');
    const rangeTanggal = document.getElementById('range_tanggal');
    const tglAwal = document.getElementById('tanggal_awal');
    const tglAkhir = document.getElementById('tanggal_akhir');

    periode.addEventListener('change', function () {
        const tahunSekarang = new Date().getFullYear();

        if (this.value === '6_bulan') {
            // tampilkan input manual
            rangeTanggal.classList.remove('d-none');
            tglAwal.value = '';
            tglAkhir.value = '';
        }

        if (this.value === '1_tahun') {
            // sembunyikan input & set otomatis
            rangeTanggal.classList.remove('d-none');
            //tglAwal.value = `${tahunSekarang}-01-01`;
            //tglAkhir.value = `${tahunSekarang}-12-31`;
            tglAwal.value = '';
            tglAkhir.value = '';
        }
    });
        flatpickr('#tanggal_awal', {
            dateFormat: 'd-m-Y'
        });
        flatpickr('#tanggal_akhir', {
            dateFormat: 'd-m-Y'
        });
        flatpickr('#tmt_pangkat', {
            dateFormat: 'd-m-Y'
        });
        flatpickr('#tmt_jabatan', {
            dateFormat: 'd-m-Y'
        });
});

  jQuery(document).ready(function ($) {
    $('#nama').on('input', function () {
         var searchQuery = $(this).val();

            if (searchQuery.length >= 4) {
                // Lakukan permintaan AJAX ke server untuk mencari Dosen
                $.ajax({ 
                    url: "{{ route('searchNama') }}",
                    method: 'GET',
                    data: { term: searchQuery },
                    success: function (data) {
                        // Bersihkan elemen daftar hasil pencarian sebelum menambahkan yang baru
                        var resultList = $('#resultList');
                        resultList.empty();

                        // Tampilkan hasil langsung sebagai JSON untuk debug
                        console.log('Server Response:', data);

                        // Tampilkan daftar hasil
                        resultList.show();

                        // Tambahkan setiap hasil ke dalam daftar
                        data.forEach(function (result) {
                            resultList.append('<li data-id="' + result.nama + '">' + result.nama + ' - ' + result.nip + '</li>');
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching data:', error);
                    }
                });
            } else {
                // Sembunyikan daftar jika input kurang dari 2 karakter
                $('#resultList').hide();
            }
        });
            // Tangani klik pada hasil list
            $(document).on('click', '#resultList li', function () {
                // Ambil ID dan Nama dari list yang dipilih
                var fullName = $(this).text();
                var splitResult = fullName.split(' - ');
            
                // Ambil ID Dosen dan Nama dari hasil split
                var nama = splitResult.length > 1 ? splitResult[0] : '';
                var nip = splitResult.length > 1 ? splitResult[1] : '';
            
                console.log('id dosen:', nama);
                console.log('Nama:', nip);

                $('#nama').val(nama);
                $('#nip').val(nip);
            
                if (!nip) {
                    $('#nama').val('');
                }
            
                // Sembunyikan list hasil
                $('#resultList').hide();
            
                });
          });  
</script>

@endsection
