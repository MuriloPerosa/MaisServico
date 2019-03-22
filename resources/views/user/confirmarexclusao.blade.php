@extends('adminlte::default')

@section('content')
    <div class="container">

        <h3><i class="fa fa-ellipsis-v"></i> Tem certeza que deseja excluir sua conta?</h3>

        <hr/>

             {!! Form::open(['route' => ['user.delete'], 'method' => 'post']) !!}

            @if($errors->any())
            <div class="col-md-12">
                <ol class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li style="margin: 10px;">{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            <div class="form-group col-md-12">
                {!! Form::label('password', 'Senha:') !!}
                {!! Form::password('password', ['class'=>'form-control', 'required', 'placeholder'=>'Informe sua senha']) !!}
            </div>


            <div class="form-group col-md-12">
                {!! Form::submit('Excluir', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/user/edit') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
