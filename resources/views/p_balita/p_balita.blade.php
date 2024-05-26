@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Data Pemeriksaan Balita') }}</h1>

    @include('pesan')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-white rounded shadow-sm border-bottom-success">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3 row justify-content-end"> <!-- Modified -->
            <div class="col-auto">
                <a href='{{ url('p_balita/create') }}' class="btn btn-primary"><i class="fa-solid fa-heart-circle-plus"></i>
                    Tambah Data</a>
            </div>
        </div>

        <div class="table-responsive"> <!-- Added -->
            <table id="p_balita_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">ID Pemeriksaan</th>
                        <th class="text-center">NIK Balita</th>
                        <th class="text-center">Nama Balita</th>
                        <th class="text-center">Berat Badan(kg)</th>
                        <th class="text-center">Panjang Badan(cm)</th>
                        <th class="text-center">Lingkar Kepala (cm)</th>
                        <th class="text-center">Lingkar Lengan (cm)</th>
                        <th class="text-center">Jenis Imunisasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data_p_balita as $item)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="text-center"> {{ $item->id_p_balita }}</td>
                            <td class="text-center">{{ $item->nik_balita }}</td>
                            <td class="text-center">{{ $item->nama_balita }}</td>
                            <td class="text-center">{{ $item->berat_badan }}</td>
                            <td class="text-center">{{ $item->panjang_badan }}</td>
                            <td class="text-center">{{ $item->lingkar_kepala }}</td>
                            <td class="text-center">{{ $item->lingkar_lengan }}</td>
                            <td class="text-center">{{ $item->jenis_imunisasi }}</td>
                            <td class="text-center">
                                <a href='{{ url('p_balita/' . $item->id_p_balita . '/edit') }}'
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button onclick="hapusData('{{ $item->id_p_balita }}')" class="btn btn-danger btn-sm"><i
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
        // Fungsi untuk menghapus data balita dengan konfirmasi Sweet Alert
        function hapusData(id_p_balita) {
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
                    // AJAX request untuk menghapus data balita
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('p_balita') }}/' + id_p_balita,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Data Pemeriksaan Balita telah dihapus.',
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

        // Inisialisasi DataTable
        $(document).ready(function() {
            $('#p_balita_table').DataTable({
                "columnDefs": [{
                        "width": "1%",
                        "targets": 0
                    }, // No
                    {
                        "width": "10%",
                        "targets": 1
                    }, // ID Pemeriksaan
                    {
                        "width": "10%",
                        "targets": 2
                    }, // NIK Balita
                    {
                        "width": "15%",
                        "targets": 3
                    }, // Nama Balita
                    {
                        "width": "10%",
                        "targets": 4
                    }, // Berat Badan
                    {
                        "width": "10%",
                        "targets": 5
                    }, // Panjang Badan
                    {
                        "width": "10%",
                        "targets": 6
                    }, // Lingkar Kepala
                    {
                        "width": "10%",
                        "targets": 7
                    }, // Lingkar Lengan
                    {
                        "width": "15%",
                        "targets": 8
                    }, // Jenis Imunisasi
                    {
                        "width": "10%",
                        "targets": 9
                    } // Aksi
                ],
                "autoWidth": false
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        #p_balita_table th,
        #p_balita_table td {
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
