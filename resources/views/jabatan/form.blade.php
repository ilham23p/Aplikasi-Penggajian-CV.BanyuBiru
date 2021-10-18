<div class="form-group">
    {!! Form::label('name', 'Nama') !!}
    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nama']) !!}
    @if ($errors->has('name'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif

</div>
<div class="form-group">
	{!! Form::label('kode_jabatan', 'Kode jabatan') !!}
	{!! Form::text('kode_jabatan', null, ['class' => $errors->has('kode_jabatan') ? 'form-control is-invalid' : $errors->has('kode_jabatan') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Kode Jabatan ...','maxlength'=>3]) !!}
	@if ($errors->has('kode_jabatan'))
	<span class="text-danger">
		<strong>{{ $errors->first('kode_jabatan') }}</strong>
	</span>
	@endif
</div>
<div class="form-group">
    {!! Form::label('pendidikan_min', 'Pendidikan Minimal') !!}
    {!! Form::text('pendidikan_min', null, ['class' => $errors->has('pendidikan_min') ? 'form-control is-invalid' : $errors->has('pendidikan_min') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pendidikan Minimal .... ']) !!}
    @if ($errors->has('pendidikan_min'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('pendidikan_min') }}</strong>
    </span>
    @endif

</div>

<div class="form-group">
    {!! Form::label('gapok', 'Gaji Pokok') !!}
    {!! Form::number('gapok', null, ['class' => $errors->has('gapok') ? 'form-control is-invalid' : $errors->has('gapok') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Gaji Pokok (Rp)', 'autocomplete' => 'off']) !!}
    @if ($errors->has('gapok'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('gapok') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('tunjangan', 'Tunjangan Jabatan') !!}
    {!! Form::number('tunjangan', null, ['class' => $errors->has('tunjangan') ? 'form-control is-invalid' : $errors->has('tunjangan') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Tunjangan (Rp)', 'autocomplete' => 'off']) !!}
    @if ($errors->has('tunjangan'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('tunjangan') }}</strong>
    </span>
    @endif

</div>

<div class="form-group">
    {!! Form::label('uang_makan', 'Tunjangan Makan') !!}
    {!! Form::number('uang_makan', null, ['class' => $errors->has('uang_makan') ? 'form-control is-invalid' : $errors->has('uang_makan') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Uang makan (Rp)', 'autocomplete' => 'off']) !!}
    @if ($errors->has('uang_makan'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('uang_makan') }}</strong>
    </span>
    @endif

</div>

<div class="form-group">
    {!! Form::label('lembur', 'Lembur') !!}
    {!! Form::number('lembur', null, ['class' => $errors->has('lembur') ? 'form-control is-invalid' : $errors->has('lembur') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Lembur (Rp) *PerJam', 'autocomplete' => 'off']) !!}
    @if ($errors->has('lembur'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('lembur') }}</strong>
    </span>
    @endif
</div>

