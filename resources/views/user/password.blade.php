@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Alterar Senha</h3>
        
        
        <hr/>
        {!! Form::open(['route' => ['user.updatepassword'], 'method' => 'put']) !!}

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
                {!! Form::label('password', 'Senha (Atual):') !!}
                {!! Form::password('password', ['class'=>'form-control', 'required', 'placeholder'=>'Informe sua senha atual']) !!}
            </div>

             <div class="form-group col-md-12">
                {!! Form::label('newPassword', 'Nova Senha:') !!}
                {!! Form::password('newPassword', ['class'=>'form-control', 'required', 'placeholder'=>'Informe a nova senha']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('confirmPassword', 'Confirmação de Senha:') !!}
                {!! Form::password('confirmPassword',   ['class'=>'form-control', 'required', 'placeholder'=>'Informe novamente a nova senha']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/user/edit') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection