@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Editar Cidade</h3>
        <hr/>
        {!! Form::open(['route' => ["cidades.update", $cidade->id], 'method'=>'put']) !!}
        
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
                {!! Form::text('nome', $cidade->nome, ['class'=>'form-control', 'required', 'placeholder'=>'Nome da cidade']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('estado_id', 'Estado:') !!}
                {!! Form::select('estado_id', $estados, $cidade->estado->id, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection