<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => ($errors->has('email') ? 'form-control is-invalid' : $errors->has('email')) ? 'form-control is-invalid' : 'form-control']) !!}
    @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    
    <label for="role">wewenang</label>
    <div class="alert alert-info" role="alert">
        @if (Auth::user()->level=="owner")
        Anda login dengan level <strong>{{ Auth::user()->level }}</strong> , anda hanya bisa menambahkan user dengan level <strong>admin</strong>
        @else
        Anda login dengan level <strong>{{ Auth::user()->level }}</strong> , anda hanya bisa menambahkan user dengan level <strong>karyawan</strong>
        @endif
      
      </div>
    <select name="role" id="role" class="form-control">
        @foreach ($roles as $r)
            @if (Auth::user()->level=="admin")
            <option value="{{ $r->alias }}" 
                <?php if ($r->alias == "admin" || $r->alias == "owner")
                {
                    echo 'disabled class="bg-gray"';
                } 
                else 
                { echo '';}?>
                >{{ $r->name }}</option>
            @elseif (Auth::user()->level=="owner")
            <option value="{{ $r->alias }}" 
                <?php if ($r->alias == "karyawan")
                {
                    echo 'disabled class="bg-gray"';
                } 
                else 
                { echo '';}?>
                >{{ $r->name }}</option>
            @endif
        @endforeach
    </select>
    @if ($errors->has('roles'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('roles') }}</strong>
        </span>
    @endif

</div>


<div class="form-group row">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => ($errors->has('password') ? 'form-control is-invalid' : $errors->has('password')) ? 'form-control is-invalid' : 'form-control']) !!}
    @if ($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

</div>

<div class="form-group row">
    {!! Form::label('password_confirmation', 'Confirm Password') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
