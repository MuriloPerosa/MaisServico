@extends('adminlte::default')

@section('content')
    <div class="container-fluid ">
        <h3><i class="fa fa-ellipsis-v"></i> Relatório Geral de Localização</h3>
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

        {!! Form::open(['route' => 'relatorios.localizacaoPost']) !!}


                    <div class="form-group col-sm-12 col-md-6">
                        {!! Form::label('estado_id', 'Estado:') !!}
                        {!! Form::select('estado_id', \App\Estado::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-sm-12 col-md-6 ">
                        <label for="">Cidade:</label>
                        <select class="form-control" name="cidade_id" id="cidade_id" >
                            <option value="">Selecione uma cidade...</option>
                                @foreach($cidades as $cid)
                                    <option value="{{ $cid->id }}">{{ $cid->nome }}</option>
                                @endforeach
                        </select>
                        </div>


            <div class="form-group col-md-12">
            {!! Form::submit('Gerar relatório', ['class'=>'btn btn-primary']) !!}
            <a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

    </div>
@endsection


@section('dyn_scripts')

    <script>
        $('#estado_id').on('change', function(e){
            console.log(e);
            var est_id = e.target.value;
            console.log("TESTE");

            //ajax
            $.get('/cidades/' + est_id, function(data){
                //success data
                //console.log(data);
                $('#cidade_id').empty();
                    $('#cidade_id').append('<option value="">Selecione uma cidade...</option>')
                $.each(data, function(index, $cidadesObj){
                    $('#cidade_id').append('<option value="'+$cidadesObj.id+'">'+$cidadesObj.nome+'</option>')
                });
            });

        });
    </script>

@endsection
