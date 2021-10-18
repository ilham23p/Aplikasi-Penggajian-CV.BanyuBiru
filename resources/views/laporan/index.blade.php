@extends('layouts.app')
@section('title', 'Laporan | Laporan Penggajian')
@section('laporan', 'menu-is-opening menu-open')
@section('lap_penggajian', 'active')
    @push('addon-style')
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Penggajian</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Penggajian</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title col-12">
                            Laporan Penggajian
                            <form action="{{ route('laporan.create') }}" method="get" class="float-right">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="">
                                <input type="submit" value="Cetak">
                            </form>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                {!! Session::get('message') !!}
                            </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>name</th>
                                    <th>tanggal</th>
                                    <th>gaji bersih</th>
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

                                    $gaji_kotor = $row->user->jabatan->gapok + $row->user->jabatan->tunjangan +
                                    $row->user->jabatan->lembur * $lembur + $masuk * $uang_makan;

                                    $tunjangan_jabatan = $row->user->jabatan->tunjangan;
                                    // $potongan_kehadiran = $row->user->jabatan->gapok - $masuk * ($row->user->jabatan->gapok
                                    // / $hari_kerja);
                                    /*gaji pokok new*/
                                    $potongan_kehadiran = ($row->user->jabatan->gapok/$hari_kerja)*($hari_kerja-$masuk); 
                                    $gaji_bersih = $gaji_kotor - $potongan_kehadiran;
                                    ?>
                                    <tr>
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! $row->user->name !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                        <td>{!! number_format($gaji_bersih) !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                             
                            </tfoot>
                        </table>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('addon-script')
    <script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

@endpush
