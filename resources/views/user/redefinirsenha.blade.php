@extends('adminlte::default')

@section('content')
    <div class="container">

        <h3><i class="fa fa-ellipsis-v"></i> Redefinir Senha</h3>


     <hr/>
             {!! Form::open(['route' => ['emails.emailsenha']]) !!}


            @if($errors->any())
            <div class="col-md-12">
                <ol class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li style="margin: 10px;">{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            <div class="form-group">
                {!! Form::label('email', 'E-mail:') !!}
                {!! Form::email('email', null, ['class'=>'form-control', 'required', 'placeholder'=>'email@mail.com']) !!}
            </div>

            <hr/>

            <div class="form-group">
                {!! Form::submit('Redefinir', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/login') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
