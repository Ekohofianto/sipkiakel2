<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Balita</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid black;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .alamat {
            text-align: center;
            margin-bottom: 20px;
        }

        .garis {
            border: 1px solid black;
            margin: 2px;
            padding: 0;
        }

        .gariss {
            border: 1.5px solid black;
            margin: 1px;
            padding: 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .signature {
            margin-top: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .signature1 {
            margin: 0;
            padding: 0;
        }

        .signature p {
            margin: 0;
            padding: 0;
        }

        .signature h2 {
            margin: 0;
            padding: 0;
        }

        .fixed-footer {
            position: absolute;
            bottom: 1cm;
            /* Sesuaikan jarak dari bawah sesuai kebutuhan Anda */
            left: 8cm;
            /* Sesuaikan jarak dari kanan sesuai kebutuhan Anda */
            width: 100%;
            display: flex;
            justify-content: center;
            /* Meratakan elemen di tengah secara horizontal */
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .fixed-footer p {
            margin: 0;
            padding: 0;
        }

        .fixed-footer u {
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="header signature">
        <h2>LAPORAN DATA BALITA</h2>
        <h2>PUSKESMAS SUMBERSARI</h2>
        <p>JL. Mastrip, Krajan Timur, Sumbersari, Kec.Sumbersari, Kabupaten Jember, Jawa Timur 68121</p>
        <p>Hp.0853-3355-2525 Email: puskesmas.sumbersari@gmail.com</p>
    </div>

    <div class="signature1">
        <div class="garis"></div>
        <div class="gariss"></div>
    </div>

    <div class="signature">
        <p>Hal : Laporan Data Balita</p>
        <p>Alamat : {{ $data_balita->first()->alamat }}</p>
        <p>Bulan : {{ $data_balita->first()->created_at->format('m') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK Balita</th>
                <th>Nama Balita</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
                <th>NIK Ibu</th>
                <th>Nama Ibu</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_balita as $balita)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $balita->nik_balita }}</td>
                    <td>{{ $balita->nama_balita }}</td>
                    <td>{{ $balita->tgl_balita }}</td>
                    <td>{{ $balita->usia }}</td>
                    <td>{{ $balita->nik_ibu }}</td>
                    <td>{{ $balita->nama_ibu }}</td>
                    <td>{{ $balita->jenis_kelamin }}</td>
                    <td>{{ $balita->alamat }}</td>
                    <td>{{ $balita->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" class="text-center"><strong>Total:</strong></td>
                <td colspan="2"><strong>{{ count($data_balita) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="fixed-footer">
        <div class="footer">
            <p>Kepala Puskesmas</p>
        </div>
        <div class="footer">
            <p> </p>
        </div>
        <div class="footer">
            <p> </p>
        </div>
        <div class="footer">
            <p> </p>
        </div>
        <div class="footer">
            <p>dr. Freddy Suseno, Sp.KK</p>
            <p><u>NIP.1234567890</u></p>
        </div>
    </div>
</body>

</html>
