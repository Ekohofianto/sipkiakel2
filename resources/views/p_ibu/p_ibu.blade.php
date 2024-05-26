@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Data Pemeriksaan Ibu') }}</h1>

    @include('pesan')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-white rounded shadow-sm border-bottom-success">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3 row justify-content-end"> <!-- Modified -->
            <div class="col-auto">
                <a href='{{ url('p_ibu/create') }}' class="btn btn-primary"><i class="fa-solid fa-heart-circle-plus"></i>
                    Tambah Data</a>
            </div>
        </div>

        <div class="table-responsive"> <!-- Added -->
            <table id="p_ibu_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">ID Pemeriksaan</th>
                        <th class="text-center">NIK Ibu</th>
                        <th class="text-center">Nama Ibu</th>
                        <th class="text-center">Berat Badan(kg)</th>
                        <th class="text-center">Tinggi Badan(cm)</th>
                        <th class="text-center">Tekanan Darah (mmHg)</th>
                        <th class="text-center">Riwayat Penyakit</th>
                        <th class="text-center">Usia Kehamilan (minggu)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data_p_ibu as $item)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="text-center"> {{ $item->id_p_ibu }}</td>
                            <td class="text-center">{{ $item->nik_ibu }}</td>
                            <td class="text-center">{{ $item->nama_ibu }}</td>
                            <td class="text-center">{{ $item->berat_b }}</td>
                            <td class="text-center">{{ $item->tinggi_b }}</td>
                            <td class="text-center">{{ $item->tekanan_d }}</td>
                            <td class="text-center">{{ $item->riwayat_p }}</td>
                            <td class="text-center">{{ $item->usia_kehamilan }}</td>
                            <td class="text-center">
                                <a href='{{ url('p_ibu/' . $item->id_p_ibu . '/edit') }}' class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <button onclick="hapusData('{{ $item->id_p_ibu }}')" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#p_ibu_table').DataTable({
                "columnDefs": [{
                        "width": "1%",
                        "targets": 0
                    }, // No
                    {
                        "width": "3%",
                        "targets": 1
                    }, // ID Pemeriksaan
                    {
                        "width": "12%",
                        "targets": 2
                    }, // NIK Ibu
                    {
                        "width": "15%",
                        "targets": 3
                    }, // Nama Ibu
                    {
                        "width": "3%",
                        "targets": 4
                    }, // Berat Badan
                    {
                        "width": "3%",
                        "targets": 5
                    }, // Tinggi Badan
                    {
                        "width": "7%",
                        "targets": 6
                    }, // Tekanan Darah
                    {
                        "width": "20%",
                        "targets": 7
                    }, // Riwayat Penyakit
                    {
                        "width": "5%",
                        "targets": 8
                    }, // Usia Kehamilan
                    {
                        "width": "10%",
                        "targets": 9
                    } // Aksi
                ],
                "autoWidth": false
            });
        });

        function hapusData(p_ibu) {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request untuk menghapus data
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('p_ibu') }}/' + p_ibu,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Data pemeriksaan ibu telah dihapus.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    location
                                        .reload(); // Refresh halaman setelah pesan SweetAlert ditutup
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection

@section('styles')
    <style>
        #p_ibu_table th,
        #p_ibu_table td {
            padding: 8px 10px;
        }

        .table-centered th {
            text-align: center !important;
        }

        .table-centered td {
            vertical-align: middle;
        }
    </style>
@endsection
