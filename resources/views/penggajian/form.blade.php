<div class="col-12">
	<div class="row">
		<div class="col-6">

			<div class="form-group">
			    {!! Form::label('user_id', 'Karyawan', ['class' => 'col-form-label']) !!}

		        <select name="user_id" class="{!! $errors->has('user_id') ? 'form-control is-invalid' : $errors->has('user_id') ? 'form-control is-invalid' : 'form-control' !!}" disabled="">
		            @foreach (App\User::where('level','karyawan')->get() as $val)
		            <option value="{!! $row->id !!}" {!! $row->id == $val->id ? 'selected' : '' !!} >{!! $val->nip !!} ({!! $val->name !!})</option>
		            @endforeach
		        </select>
		        @if ($errors->has('user_id'))
		            <span class="invalid-feedback">
		                <strong>{{ $errors->first('user_id') }}</strong>
		            </span>
		        @endif
			</div>

			<div class="form-group">
			    {!! Form::label('jenis_karyawan', 'Jenis Karyawan', ['class' => 'col-form-label']) !!}

				{!! Form::select('jenis_karyawan', ['Tetap'=>'Tetap', 'Sementara'=>'Sementara'], null, ['class' => $errors->has('jenis_karyawan') ? 'form-control is-invalid' : $errors->has('jenis_karyawan') ? 'form-control is-invalid' : 'form-control', 'readonly']) !!}
			    @if ($errors->has('jenis_karyawan'))
			        <span class="invalid-feedback">
			            <strong>{{ $errors->first('jenis_karyawan') }}</strong>
			        </span>
			    @endif
			</div>

			<div class="row">
				<div class="col-3">
					{!! Form::label('masuk', 'Masuk', ['class'=>'']) !!}
					{!! Form::text('masuk', $row->absensi()->masuk($row->id), []) !!}
				</div>	
				<div class="col-3">
					{!! Form::label('ijin', 'Ijin', ['class'=>'']) !!}
					{!! Form::text('ijin', $row->absensi()->ijin($row->id), []) !!}
				</div>	
				<div class="col-3">
					{!! Form::label('cuti', 'Cuti', ['class'=>'']) !!}
					{!! Form::text('cuti', $row->absensi()->cuti($row->id), []) !!}
				</div>	
				<div class="col-3">
					{!! Form::label('alpa', 'Alpa', ['class'=>'']) !!}
					{!! Form::text('alpa', $row->absensi()->alpa($row->id), []) !!}
				</div>	
			</div>

			<div class="form-group">
				{!! Form::label('tanggal', 'Tanggal', []) !!}
				{!! Form::text('tanggal', Carbon\Carbon::now()->format('Y-m-d'), ['class'=>'form-control', 'readonly']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('total_lembur', 'Total Lembur bulan ini', []) !!}
				<p>{!! $row->lembur()->totalLembur($row->id) !!} jam X {!! number_format($row->jabatan->lembur) !!}
				</p>
			</div>

			<div class="form-group">
				<img src="{{ asset('upload/users/'.$row->image) }}">
			</div>

		</div>

		{!! Form::open(['route'=>'laporan.store', 'method'=>'post', 'id'=>'gajian'.$row->id]) !!}

		{!! Form::hidden('user_id', $row->id, []) !!}
		{!! Form::hidden('bulan', \Carbon\Carbon::now()->month, []) !!}
		{!! Form::hidden('tahun', \Carbon\Carbon::now()->year, []) !!}
		
		<div class="col-6">
			<div class="form-group">
				{!! Form::label('gapok', 'Gaji pokok (Rp)', []) !!}
				{!! Form::text('gapok', $row->jabatan->gapok, ['class'=>'form-control', 'readonly']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('tunjangan', 'Tunjangan (Rp)', []) !!}
				{!! Form::text('tunjangan', $row->jabatan->tunjangan, ['class'=>'form-control', 'readonly']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('lembur', 'Lembur (Rp)', []) !!}
				{!! Form::text('lembur', $row->lembur()->totalLembur($row->id)*$row->jabatan->lembur, ['class'=>'form-control', 'readonly']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('gaji kotor', 'Gaji Kotor (Rp)', []) !!}
				{!! Form::text('gaji_kotor', $row->jabatan->gapok + $row->jabatan->tunjangan + $row->lembur()->totalLembur($row->id)*$row->jabatan->lembur, ['class'=>'form-control', 'readonly']) !!}
			</div>

			<div class="form-group">
				<?php
				$jumlah_hari = date('t');
        date_default_timezone_set("Asia/Jakarta");

        $array = json_decode(file_get_contents("calendar.json"), true);
        $month = date('m');
        $year = date('Y');
        $jumlah_libur_minggu = array();
        $jumlah_libur_nasional = array();
        for ($d = 1; $d <= $jumlah_hari; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month) {
                $hari_bulan = date('Ymd', $time);
                if (isset($array[$hari_bulan])) {
                    $keterangan = $d . "-" . $month . "-" . $year . " " . $array[$hari_bulan]["deskripsi"];
                    $jumlah_libur_nasional[] = $d;
                } elseif (date("D", strtotime($hari_bulan)) === "Sun") {
                    $jumlah_libur_minggu[] = $d;
                }
            }
        }
        $minggu = count($jumlah_libur_minggu);
        $nasional = count($jumlah_libur_nasional);
        $hari_kerja = ($jumlah_hari - ($minggu + $nasional));
					$gaji_pokok=$row->jabatan->gapok;
					$jumlah_masuk=$row->absensi()->masuk($row->id);
					$potongan_kehadiran=$gaji_pokok-$jumlah_masuk*($gaji_pokok/$hari_kerja);
				?>
				{!! Form::label('gaji_bersih', 'Gaji Bersih (Rp)', []) !!}
				{!! Form::text('gaji_bersih', (($row->jabatan->gapok+$row->jabatan->tunjangan+$row->jabatan->uang_makan*$jumlah_masuk+($row->lembur()->totalLembur($row->id)*$row->jabatan->lembur))-($potongan_kehadiran)), ['class'=>'form-control', 'readonly']) !!}

			
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>