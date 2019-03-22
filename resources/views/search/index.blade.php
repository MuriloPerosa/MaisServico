@extends('adminlte::default')

@section('content')
    <div class="container-fluid ">
        <h3><i class="fa fa-ellipsis-v"></i> Pesquisar</h3>
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

        {!! Form::open(['route' => 'search.form']) !!}

        <div class="form-group  col-md-12">
                {!! Form::label('categoria_id', 'Categoria:') !!}
                {!! Form::select('categoria_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control', 'required', 'id'=>'categoria_id']) !!}
            </div>

                    <div class="form-group col-sm-12 col-md-6">
                        {!! Form::label('estado_id', 'Estado:') !!}
                        {!! Form::select('estado_id', \App\Estado::orderBy('nome')->pluck('nome', 'id')->toArray(), null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="">Cidade:</label>
                        <select class="form-control" name="cidade_id" id="cidade_id" required>
                            <option value="">Selecione uma cidade...</option>    
                                @foreach($cidades as $cid)
                                    <option value="{{ $cid->id }}">{{ $cid->nome }}</option>
                                @endforeach
                        </select>
                    </div>
  

            <div class="form-group col-md-12">
                {!! Form::label('tipo', 'Tipo:') !!}
                {!! Form::select('tipo', array(1=>'Ofertas', 2 => 'Necessidades'), null, ['class'=>'form-control', 'id'=>'tipo', 'required']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('ordenacao', 'Ordenação:') !!}
                {!! Form::select('ordenacao', array(''=> 'Selecione uma ordenção...',0=>'Avaliações', 1=>'Data', 2 => 'Maior Preço', 3 => 'Menor Preço'), null, ['class'=>'form-control', 'required']) !!}
            </div>
        

            <div class="form-group col-md-12">
            <hr/>
            <!-- {!! Form::submit('Pesquisar', ['class'=>'btn btn-primary']) !!} -->
            <a href="#" class="btn btn-primary" id="btnPesquisar">Pesquisar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

    </div>
@endsection


@section('dyn_scripts')
    <script>

    // $(document).ready(function() {
    //     $('#categoria_id').append('<option value="" selected>Selecione uma categoria...</option>')
    // });

     $('#tipo').on('change', function(e){
            var val = $('#tipo').val();
            $('#ordenacao').empty();
            if(val == 1){
                $('#ordenacao').append('<option value="">Selecione uma ordenção...</option>')
                $('#ordenacao').append('<option value="0">Avaliações</option>')
                $('#ordenacao').append('<option value="1">Data</option>')
                $('#ordenacao').append('<option value="2">Maior Preço</option>')
                $('#ordenacao').append('<option value="3">Menor Preço</option>')
            }else if(val == 2){
                $('#ordenacao').append('<option value="1" selected>Data</option>')
            }
     });


        $('#estado_id').on('change', function(e){
            console.log(e);
            var est_id = e.target.value;
            console.log("TESTE");

            //ajax
            $.get('/cidades/' + est_id+'/get', function(data){
                //success data
                //console.log(data);
                $('#cidade_id').empty();
                    $('#cidade_id').append('<option value="">Selecione uma cidade...</option>')
                $.each(data, function(index, $cidadesObj){
                    $('#cidade_id').append('<option value="'+$cidadesObj.id+'">'+$cidadesObj.nome+'</option>')
                });
            });

        });

        function null_or_empty(str) {
       
            return str == null || str == "";
        }
        
        $('#btnPesquisar').on('click', function(e){
            var cidade =  $("#cidade_id").val();
            var tipo =  $("#tipo").val();
            var categoria =  $("#categoria_id").val();
            var ordenacao =  $("#ordenacao").val();

            if (null_or_empty(cidade))
            {
                alert('Atenção! Informe uma cidade de pesquisa!');
                return false;
            }
            else if(null_or_empty(tipo))  
            {
                alert('Atenção! Informe um tipo de pesquisa!');
                return false;
            }
            else if(null_or_empty(categoria))  
            {
                alert('Atenção! Informe uma categoria de pesquisa!');
                return false;
            }
            else if(null_or_empty(ordenacao))  
            {
                alert('Atenção! Informe uma oredenação de pesquisa!');
                return false;
            }


            window.location = '/search/' + cidade+'/'+tipo+'/'+categoria+'/'+ordenacao+'/result'
            //ajax
            // $.get('/search/' + cidade+'/'+tipo+'/'+categoria+'/'+ordenacao+'/result');
        });
    </script>
@endsection