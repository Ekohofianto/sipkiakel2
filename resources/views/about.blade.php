@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">SIPKIA</h5>
                            <p>Sistem Informasi Pelaporan Kesehatan Ibu dan Anak</p>
                            <p>Sipkia adalah sebuah platform yang dirancang khusus untuk memperbaiki proses pelayanan
                                kesehatan di Posyandu. Dengan fokus pada pelayanan ibu dan anak, SIPKIA memungkinkan
                                pendataan, pemeriksaan, dan pemantauan kesehatan yang lebih efisien dan efektif.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
