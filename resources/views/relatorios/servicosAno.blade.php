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

        <h3><i class="fa fa-ellipsis-v"></i> Relatório de Serviços Realizados por Ano</h3>
        <hr/>

        {!! Form::open(['route' => 'relatorios.servicosAnoPost']) !!}


            <div class="form-group col-md-12">
                {!! Form::label('ano', 'Ano:') !!}
                {!! Form::select('ano', ["2018"=>"2018", "2017"=>"2017", "2016"=>"2016"], "2018", ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-12">
            {!! Form::submit('Gerar Relatório', ['class'=>'btn btn-primary']) !!}
            <a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

    </div>


@endsection
