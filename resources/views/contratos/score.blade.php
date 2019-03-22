@extends('adminlte::default')

@section('content')
<div class="container-fluid ">
    <h3><i class="fa fa-ellipsis-v"></i> Avaliar Serviço</h3>
    <hr/>

    @if($errors->any())
        <div class="col-md-12">
            <ol class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li style="margin: 10px;">{{ $error }}</li>
                @endforeach
            </ol>
        </div>
     @endif
     
     <div class="row">
            <div class="col-md-12">
            {!! Form::open(['route' => ["contratos.setscore", $contrato->id], 'method'=>'put']) !!}

            <div class="form-group col-md-12">
                {!! Form::label('avaliacao_nota', 'Nota:') !!}
                {!! Form::select('avaliacao_nota',array('10'=>'10', '9'=>'9', '8'=>'8', '7'=>'7', '6'=>'6', '5'=>'5', '4'=>'4', '3'=>'3', '2'=>'2', '1'=>'1', '0'=>'0' ) , '10', ['class'=>'form-control', 'required']) !!}
            </div>
            
            <div class="form-group col-md-12">
                {!! Form::label('avaliacao_cmt', 'Comentário:') !!}
                {!! Form::textarea('avaliacao_cmt', null, ['rows' => 5, 'maxlength' => 255, 'style' => 'resize:none', 'class'=>'form-control', 'placeholder'=>'Comentário sobre o serviço realizado (Máx: 255 carcteres)']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
                <a href="{{ url('/contratos') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

</div>
@endsection