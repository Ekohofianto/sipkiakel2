@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Ubah Data Pemeriksaan Ibu') }}</h1>

    @include('pesan')

    <form action="{{ url('p_ibu/' . $data_p_ibu->id_p_ibu) }}" method="post">
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nik_ibu" class="col-sm-2 col-form-label">NIK Ibu<span class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nik_ibu" value="{{ $data_p_ibu->nik_ibu }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_ibu" value="{{ $data_p_ibu->nama_ibu }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="berat_b" class="col-sm-2 col-form-label">Berat Badan (kg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="berat_b"
                        value="{{ $data_p_ibu->berat_b }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tinggi_b" class="col-sm-2 col-form-label">Tinggi Badan (cm)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="tinggi_b"
                        value="{{ $data_p_ibu->tinggi_b }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tekanan_d" class="col-sm-2 col-form-label">Tekanan Darah (mmHg)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tekanan_d" value="{{ $data_p_ibu->tekanan_d }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="riwayat_p" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="riwayat_p" rows="3">{{ $data_p_ibu->riwayat_p }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usia_kehamilan" class="col-sm-2 col-form-label">Usia Kehamilan (minggu)<span
                        class="small text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="usia_kehamilan"
                        value="{{ $data_p_ibu->usia_kehamilan }}">
                </div>
            </div>
            <style>
                #alamat-wrapper {
                    display: none;
                }
            </style>

            <div id="alamat-wrapper" class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{ Session::get('alamat') }}"
                        id="alamat" readonly>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-1 text-center">
                    <a href='{{ url('p_ibu') }}' class="btn btn-secondary mb-3"><i
                            class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-sm-1 text-center">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa-solid fa-floppy-disk"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
