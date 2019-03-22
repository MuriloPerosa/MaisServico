@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Editar Palavra-Chave</h3>
        <hr/>
        {!! Form::open(['route' => ["palavras.update", $palavra->id], 'method'=>'put']) !!}


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
                {!! Form::label('palavra', 'Palavra:') !!}
                {!! Form::text('palavra', $palavra->palavra, ['class'=>'form-control', 'required', 'placeholder'=>'Informe a palavra...']) !!}
            </div>


            <div class="form-group col-md-12">
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection