@extends('adminlte::default')

@section('content')
    <div class="container-fluid ">

        @if($errors->any())
            <div class="col-md-12">
                <ol class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li style="margin: 10px;">{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        <h3><i class="fa fa-ellipsis-v"></i> Relatório Geral de Categoria</h3>
        <hr/>

        {!! Form::open(['route' => 'relatorios.categoriaPost']) !!}


            <div class="form-group col-md-12">
                {!! Form::label('categoria_id', 'Categoria:') !!}
                {!! Form::select('categoria_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-12">
            {!! Form::submit('Gerar Relatório', ['class'=>'btn btn-primary']) !!}
            <a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

    </div>


@endsection
