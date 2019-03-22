@extends('adminlte::default')

@section('content')
    <div class="container-fluid">

        <h3><i class="fa fa-ellipsis-v"></i> Editar Categoria</h3>
        <hr/>
        {!! Form::open(['route' => ["categorias.update", $categoria->id], 'method'=>'put']) !!}

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
                {!! Form::text('nome', $categoria->nome, ['class'=>'form-control', 'required', 'placeholder'=>'Nome da categoria']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('descricao', 'Descrição:') !!}
                {!! Form::textarea('descricao', $categoria->descricao, ['class'=>'form-control', 'required', 'placeholder'=>'Descrição da categoria', 'style' => 'resize:none', 'maxlength' => 255, 'rows'=> 5]) !!}
            </div>
            <div class="form-group col-md-12">
            <h4>Palavras-Chave</h4>

            <div class="input_fields_wrap">
            @foreach( $categoria->categoria_palavras as $cp)

            <div>
                <div style="width:94%; float:left" id="palavra">
                    {!! Form::select("itens[]",
                        \App\PalavraChave::orderBy("palavra")->pluck("palavra", "id")->toArray(),
                        $cp->palavra->id,
                        ["class"=>"form-control", "required",
                            "placeholder"=>"Selecione uma palavra"])
                    !!}
                </div>
                <button type="button" class="remove_field btn btn-danger btn-circle">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            @endforeach  
            </div>
            <br>

            <button style="float:right;" class="add_field_button btn btn-success">Adicionar Palavra-Chave</button>

            <br>

            <hr />
            </div>


            <div class="form-group col-md-12">
                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
               <a href="{{ url('/categorias') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('dyn_scripts')
<script>
    $(document).ready(function(){
        var wrapper = $(".input_fields_wrap");
        var add_button = $(".add_field_button");
        var x = 0;
        $(add_button).click(function(e){
            x++;
            var newField = 
            `<div>
                <div style="width:94%; float:left" id="palavra">
                    {!! Form::select("itens[]",
                        \App\PalavraChave::orderBy("palavra")->pluck("palavra", "id")->toArray(),
                        null,
                        ["class"=>"form-control", "required",
                            "placeholder"=>"Selecione uma palavra"])
                    !!}
                </div>
                <button type="button" class="remove_field btn btn-danger btn-circle">
                    <i class="fa fa-times"></i>
                </button>
            </div>`;
            $(wrapper).append(newField);            
        });

        $(wrapper).on("click",".remove_field", function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
@endsection