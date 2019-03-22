@extends('adminlte::default')

@section('content')
    <div class="container-fluid ">
        <h3><i class="fa fa-ellipsis-v"></i> Editar Necessidade</h3>
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

             {!! Form::open(['route' => ["necessidades.update", $necessidade->id], 'method'=>'put']) !!}

    
         <div class="form-group col-md-12">
                {!! Form::label('categoria_id', 'Categoria:') !!}
                {!! Form::select('categoria_id', \App\Categoria::orderBy('nome')->pluck('nome', 'id')->toArray(), $necessidade->categoria_id, ['class'=>'form-control', 'required']) !!}
         </div>

          <div class="form-group col-md-12">
                {!! Form::label('titulo', 'Título:') !!}
                {!! Form::text('titulo', $necessidade->titulo, ['class'=>'form-control', 'placeholder'=>'Título da oferta']) !!}
            </div>
            
            <div class="form-group col-md-12">
                {!! Form::label('descricao', 'Descrição:') !!}
                {!! Form::textarea('descricao', $necessidade->descricao, ['rows' => 5, 'maxlength' => 255, 'style' => 'resize:none', 'class'=>'form-control', 'placeholder'=>'Descrição da oferta (Máx: 255 carcteres)']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('data_limite', 'Data Limite:') !!}
                {!! Form::date('data_limite', $necessidade->data_limite, ['class'=>'form-control']) !!}
            </div>

                    <div class="form-group col-sm-12 col-md-6">
                        {!! Form::label('estado_id', 'Estado:') !!}
                        {!! Form::select('estado_id', \App\Estado::orderBy('nome')->pluck('nome', 'id')->toArray(), $necessidade->cidade->estado_id, ['class'=>'form-control', 'required']) !!}
                    </div>
                
                <div class="form-group col-sm-12 col-md-6">
                        <label for="">Cidade:</label>
                        <select class="form-control" name="cidade_id" id="cidade_id" >
                            <option value="">Selecione uma cidade...</option>    
                                @foreach($cidades as $cid)
                                    @if($cid->id == $necessidade->cidade_id)
                                        <option value="{{ $cid->id }}" selected>{{ $cid->nome }}</option>
                                    @else
                                        <option value="{{ $cid->id }}">{{ $cid->nome }}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                


               
                <div class="form-group col-sm-12 col-md-6">
                        {!! Form::label('telefone', 'Telefone:') !!}
                        {!! Form::text('telefone',  $necessidade->telefone, ['class'=>'form-control', 'placeholder' => 'Telefone para contato']); !!}
                       
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        {!! Form::label('celular', 'Celular:') !!}
                        {!! Form::text('celular',  $necessidade->celular, ['class'=>'form-control', 'placeholder'=>'Celular para contato']) !!}    
                    </div>
       
       
            <div class="form-group col-md-12">
                {!! Form::label('email', 'E-mail:') !!}
                {!! Form::email('email',  $necessidade->email, ['class'=>'form-control', 'placeholder'=>'E-mail para contato']) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('observacoes', 'Observações:') !!}
                {!! Form::textarea('observacoes',  $necessidade->observacoes, ['rows' => 5, 'maxlength' => 255, 'style' => 'resize:none', 'class'=>'form-control', 'placeholder'=>'Descrição da oferta (Máx: 255 carcteres)']) !!}
            </div>
        

            <div class="form-group">
                {!! Form::hidden('user_id', Auth::user()->id) !!}
            </div>

             <hr/>


            <div class="form-group col-md-12">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            <a href="{{ url('/necessidades') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}

    </div>
@endsection


@section('dyn_scripts')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

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

        $('#telefone').mask('(99) 9999-9999');
        $('#cpf').mask('999.999.999-99');
        $('#celular').mask('(99) 99999-9999');
    </script>

@endsection