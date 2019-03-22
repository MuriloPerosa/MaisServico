@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Nova Cidade</h3>
        <hr/>
        {!! Form::open(['route' => 'cidades.store']) !!}


	        @if($pessoa->cidade_id == 0)
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <ol>
                            <li style="margin: 10px;">Usuário sem cidade cadastrada. A próxima que você cadastrar será automaticamente definida como sua cidade padrão.</li>
                        </ol>
                    </div>
                    <hr/>
                </div>
            @endif

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
                {!! Form::label('nome', 'Nome:') !!}
                {!! Form::text('nome', null, ['class'=>'form-control', 'required', 'placeholder'=>'Nome da cidade']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('estado_id', 'Estado:') !!}
                {!! Form::select('estado_id', $estados, null, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection