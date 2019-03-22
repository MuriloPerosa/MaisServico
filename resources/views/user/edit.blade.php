@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
    @if(empty($pessoa->cpf) == false)
        <h3><i class="fa fa-ellipsis-v"></i> Alterar Conta</h3>
    @else
        <h3><i class="fa fa-ellipsis-v"></i> Informar Dados</h3>
    @endif
        <hr/>

     
             {!! Form::open(['route' => ['user.update'], 'method' => 'put']) !!}
       
             @if(session('register'))
                <div class="alert alert-danger text-center">
                    {{ session('register') }}
                </div>
                <hr/>
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
                {!! Form::label('rg', 'RG:') !!}
                {!! Form::text('rg', $pessoa->rg, ['class'=>'form-control', 'required', 'placeholder'=>'Informe o RG']) !!}
            </div>

             <div class="form-group col-md-12">
                {!! Form::label('cpf', 'CPF:') !!}
                {!! Form::text('cpf', $pessoa->cpf, ['class'=>'form-control', 'required', 'placeholder'=>'Informe o CPF']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('telefone', 'Telefone:') !!}
                {!! Form::text('telefone', $pessoa->telefone, ['class'=>'form-control', 'placeholder'=>'Informe o telefone']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('celular', 'Celular:') !!}
                {!! Form::text('celular', $pessoa->celular, ['class'=>'form-control', 'placeholder'=>'Informe o celular']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('data_nascimento', 'Data de Nascimento:') !!}
                {!! Form::date('data_nascimento', $pessoa->data_nascimento, ['class'=>'form-control', 'required']) !!}
            </div>

          <div class="form-group col-sm-12 col-md-6">
          <label for="">Estado:</label>
                <select class="form-control" name="estado_id" id="estado_id">
                   <option>Selecione um estado...</option>
                    @foreach($estados as $estado)
                        @if($cidade != null)
                            @if($estado->id === $cidade->estado_id)
                                <option value="{{ $estado->id }}" selected>{{ $estado->nome }}</option>
                            @else
                                <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                            @endif
                        @else
                             <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                        @endif
              
                    @endforeach
                </select>
            </div>


            <div class="form-group col-sm-12 col-md-6">
                <label for="">Cidade:</label>
                <select class="form-control" name="cidade_id" id="cidade_id" >
                        @if($cidade != null)
                            @foreach($cidades as $cid)
                                    @if($cid->id === $cidade->id)
                                        <option value="{{ $cid->id }}" selected>{{ $cid->nome }}</option>
                                    @else
                                        <option value="{{ $cid->id }}">{{ $cid->nome }}</option>
                                    @endif
                            @endforeach
                        @else
                         <option value="">Selecione uma cidade...</option>    
                         @foreach($cidades as $cid)
                                        <option value="{{ $cid->id }}">{{ $cid->nome }}</option>
                            @endforeach
                        @endif
                </select>
            </div>


            <div class="form-group col-md-12">
            @if(!empty($pessoa->cpf))
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            @else
                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
           @endif
                <a href="{{ url('/user/password') }}" class="btn btn-primary">Alterar Senha</a>
                <!-- <a href="{{ url('/user/confirmarexclusao') }}" class="btn btn-danger">Excluir Conta</a> -->
                <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
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
                    $('#cidade_id').append('<option value="0">Cidade não cadastrada</option>')
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