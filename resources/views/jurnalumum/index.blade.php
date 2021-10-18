@extends('layouts.app')
<title>LAPORAN JURNAL UMUM CV. BANYU BIRU - Bulan : {{date('M-Y')}} <hr></title>
@section('laporan', 'menu-is-opening menu-open')
@section('lap_jurnal_umum', 'active')
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
                        <h1 class="m-0">Laporan Jurnal Umum</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Jurnal Umum</li>
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
                            Lapporan Penggajian - CV. BANYU BIRU 
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                {!! Session::get('message') !!}
                            </div>
                        @endif
                       
                        <table  id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurnalUmum as $key => $row)
                                    @if ($row->keterangan == 'Gaji')
                                        <tr>
                                            <td>
                                                {!! $row->tanggal !!}</td>
                                            <td ><strong>{!! $row->keterangan !!}</strong></td>
                                            <td>{!! number_format($row->debit) !!}</td>
                                            <td>{!! number_format($row->kredit) !!}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{!! $row->tanggal !!}</td>
                                            <td align="right"><strong>{!! $row->keterangan !!}</strong></td>
                                            <td >{!! number_format($row->debit) !!}</td>
                                            <td>{!! number_format($row->kredit) !!}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
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
      $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
    </script>
@endpush
