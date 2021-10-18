<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penggajian </title>
</head>

<body onload="window.print()">
    <center>
        <div class="text-center">
            <img src="{{ url('images/logo.png') }}" alt="logo" class="img-fluid" width="150"><br>
            <h1>LAPORAN PENGGAJIAN PADA <br> {!! config('app.name') !!} </h1>
            <hr>
            <h3>Periode Tanggal : {{ $tanggal_awal }} S.D {{ $tanggal_akhir }}</h3>
            <hr>
        </div>
    </center>


    <table width="100%" border="1" style="  border-collapse: collapse;">
        <thead>
            <tr style="  background: #fefefe;">
                <th>NO</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Hari Kerja</th>
                <th width="13%">Absensi</>
                <th>Total Jam Lembur</th>
                <th>Upah Lembur</th>
                <th>Tunjangan Jabatan</th>
                <th>Tunjangan Makan</th>
                <th>Gaji Kotor</th>
                <th>Potongan Kehadiran</th>
                <th>Gaji bersih</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_ijin = 0;
            $total_sakit = 0;
            $total_masuk = 0;
            $total_lembur = 0;
            $total_upah_lembur = 0;
            $total_tunjangan_jabatan = 0;
            $total_uang_makan = 0;
            $total_gaji_kotor = 0;
            $total_potongan_kehadiran = 0;
            $total_gaji_bersih = 0;
            $tanggal_skrng = date('m');
            ?>
            @foreach ($laporan as $key => $row)
                <?php
                $upah_lembur = $row->user->jabatan->lembur;
                $uang_makan = $row->user->jabatan->uang_makan;
                $lembur = DB::table('lemburs')
                    ->where('user_id', $row->user->id)
                    ->whereMonth('tanggal', $tanggal_skrng)
                    ->sum('lama_lembur');
                $masuk = DB::table('absensis')
                    ->where('user_id', $row->user->id)
                    ->where('status', 'Masuk')
                    ->whereMonth('tanggal', $tanggal_skrng)
                    ->count();
                $ijin = DB::table('absensis')
                    ->where('user_id', $row->user->id)
                    ->where('status', 'Ijin')
                    ->whereMonth('tanggal', $tanggal_skrng)
                    ->count();
                $sakit = DB::table('absensis')
                    ->where('user_id', $row->user->id)
                    ->where('status', 'Sakit')
                    ->whereMonth('tanggal', $tanggal_skrng)
                    ->count();
                $gaji_kotor = $row->user->jabatan->gapok + $row->user->jabatan->tunjangan + $row->user->jabatan->lembur * $lembur + $masuk * $uang_makan;
                $tunjangan_jabatan = $row->user->jabatan->tunjangan;
                /*gaji pokok new*/
                $potongan_kehadiran = ($row->user->jabatan->gapok / $hari_kerja) * ($hari_kerja - $masuk);
                $gaji_bersih = $gaji_kotor - $potongan_kehadiran;
                ?>
                <tr class="tr-shadow" align="center">
                    <td>{!! $loop->iteration !!}</td>
                    <td>{!! $row->user->name !!}</td>
                    <td>{!! $row->user->jabatan->name !!}</td>
                    <td>Rp. {!! number_format($row->gapok) !!}</td>
                    <td>{{ $hari_kerja }}</td>
                    <td>{!! $ijin !!} Ijin | {!! $sakit !!} Sakit | {!! $masuk !!} Masuk
                        <br>
                    </td>
                    <td>{!! $lembur !!} Jam</td>
                    <td>Rp. {!! number_format($upah_lembur) !!}</td>
                    <td>Rp. {!! number_format($tunjangan_jabatan) !!}</td>
                    <td>Rp. {!! number_format($uang_makan * $masuk) !!}</td>
                    <td>Rp. {!! number_format($gaji_kotor) !!}</td>
                    <td>Rp. {!! number_format($potongan_kehadiran) !!}</td>
                    <td>Rp. {!! number_format($gaji_bersih) !!}</td>
                </tr>
                <tr class="spacer"></tr>
                <?php
                $total_ijin = $total_ijin += $ijin;
                $total_sakit = $total_sakit += $sakit;
                $total_masuk = $total_masuk += $masuk;
                $total_lembur = $total_lembur += $lembur;
                $total_upah_lembur = $total_upah_lembur += $upah_lembur;
                $total_tunjangan_jabatan = $total_tunjangan_jabatan += $tunjangan_jabatan;
                $total_uang_makan = $total_uang_makan += $uang_makan * $masuk;
                $total_gaji_kotor = $total_gaji_kotor += $gaji_kotor;
                $total_potongan_kehadiran = $total_potongan_kehadiran += $potongan_kehadiran;
                $total_gaji_bersih = $total_gaji_bersih += $gaji_bersih;
                ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr align="center" style="background: #e7e7e7,font-weight:bold">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <strong>
                        {{ $total_ijin }} Ijin | {{ $total_sakit }} Sakit | {{ $total_masuk }} Masuk
                    </strong>
                </td>
                <td> {{ $total_lembur }} Jam</td>
                <td>Rp. {!! number_format($total_upah_lembur) !!}</td>
                <td>Rp. {!! number_format($total_tunjangan_jabatan) !!}</td>
                <td>Rp. {!! number_format($total_uang_makan) !!}</td>
                <td>Rp. {!! number_format($total_gaji_kotor) !!}</td>
                <td>Rp. {!! number_format($total_potongan_kehadiran) !!}</td>
                <td>Rp. {!! number_format($total_gaji_bersih) !!}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
