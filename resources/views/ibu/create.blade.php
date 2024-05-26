@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Masukkan Data Ibu') }}</h1>

    @include('pesan')

    @php
        $desa_patrang = [
            '--Pilih Alamat--',
            'Blimbing',
            'Jenggawah',
            'Jepun',
            'Kalirejo',
            'Karangnongko',
            'Kemuning',
            'Kepel',
            'Kranji',
            'Kunir',
            'Mangli',
            'Mlandingan',
            'Patrang',
            'Plumbon',
            'Pucangsewu',
            'Rowobangun',
            'Sumberbendo',
            'Talun',
            'Tlogoagung',
            'Tlogomas',
            'Wuluhan',
        ];
    @endphp

    <!-- START FORM -->
    <form action="{{ url('ibu') }}" method="post">
        @csrf
        <!-- Elemen-elemen formulir lainnya -->
        <div class="my-3 p-3 bg-white rounded shadow-lg p-3 mb-5 border-bottom-success">
            <div class="mb-3 row">
                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nik_ibu" value="{{ old('nik_ibu') }}" id="nik_ibu">
                    @error('nik_ibu')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_ibu" class="col-sm-2 col-form-label">Nama<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}" id="nama_ibu">
                    @error('nama_ibu')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_ibu" class="col-sm-2 col-form-label">Tanggal Lahir<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_ibu" value="{{ old('tgl_ibu') }}" id="tgl_ibu">
                    @error('tgl_ibu')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usia" class="col-sm-2 col-form-label">Usia<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="usia" value="{{ old('usia') }}" id="usia"
                        readonly>
                    @error('usia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_suami" class="col-sm-2 col-form-label">Nama Suami</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_suami" value="{{ old('nama_suami') }}"
                        id="nama_suami">
                    @error('nama_suami')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-select form-control" name="alamat" id="alamat">
                        @foreach ($desa_patrang as $desa)
                            <option value="{{ $desa }}" {{ old('alamat') == $desa ? 'selected' : '' }}>
                                {{ $desa }}
                            </option>
                        @endforeach
                    </select>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('ibu') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <!-- AKHIR FORM -->
    <script>
        document.getElementById('tgl_ibu').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('usia').value = age;
        });

        document.addEventListener('DOMContentLoaded', function() {
            var alamatSelect = document.getElementById('alamat');
            var originalAlamatValue = alamatSelect.value;

            document.querySelector('form').addEventListener('submit', function(event) {
                if (alamatSelect.value === '--Pilih Alamat--') {
                    event.preventDefault(); // Hindari pengiriman formulir jika alamat belum dipilih
                    alert('Alamat belum dipilih.');
                }
            });
        });
    </script>
@endsection
