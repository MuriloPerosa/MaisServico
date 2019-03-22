@extends('adminlte::default')

@section('content')
<div class="container-fluid ">
    <h3><i class="fa fa-ellipsis-v"></i> Preencher Contrato</h3>
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

    @if(session('g_errors'))
        <div class="col-md-12">
            <ol class="alert alert-danger">
                {{ session('g_errors') }}
            </ol>
        </div>
     @endif

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

     <div class="row">
            <div class="col-md-12 col-lg-8">

               {!! Form::open(['route' => ['contratos.save', $contrato->id], 'method'=>'put']) !!}
            <div class="form-group col-md-12">
                {!! Form::label('endereco', 'Endereço:') !!}
                {!! Form::textarea('endereco', $contrato->endereco, ['rows' => 3, 'maxlength' => 255, 'style' => 'resize:none', 'class'=>'form-control', 'placeholder'=>'Endereço (Máx: 255 carcteres)']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('preco', 'Preço Total (R$):') !!}
                {!! Form::number('preco', $contrato->preco, ['class'=>'form-control', 'placeholder' => 'R$ 0,00', 'min'=>0, 'step'=>0.01]); !!}

            </div>
            
            <div class="form-group col-sm-12 col-md-6">
                {!! Form::label('data_inicio', 'Data Início:') !!}
                <input type="datetime-local" name="data_inicio" class="form-control" value="{{$contrato->dataInicioForms()}}">
            </div>

            <div class="form-group col-sm-12 col-md-6">
                {!! Form::label('data_fim', 'Data Fim:') !!}
                <input type="datetime-local" name="data_fim" class="form-control" value="{{$contrato->dataFimForms()}}">
            </div>


            <div class="form-group col-md-12">
                {!! Form::label('observacoes', 'Observações:') !!}
                {!! Form::textarea('observacoes', $contrato->observacoes, ['rows' => 5, 'maxlength' => 255, 'style' => 'resize:none', 'class'=>'form-control', 'placeholder'=>'Descrição da oferta (Máx: 255 carcteres)']) !!}
            </div>


            <div class="form-group col-md-12">
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
                <a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
                @if($contrato->oferta->user->id === $user->id)
                    @if($preenchido)
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalGerar" ><i class="fa fa-chain"></i> Gerar</a></button>
                    @else
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalGerar" disabled><i class="fa fa-chain"></i> Gerar</a></button>
                    @endif
                @endif
            </div>
        {!! Form::close() !!}



        </div>
     
        <div class="col-md-12 col-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <strong>Contratante: </strong>{{ $user->name }}<br>
                    <strong>Contratado: </strong>{{ $contrato->oferta->user->name }}<br>
                    <strong>Cidade: </strong> {{ $contrato->oferta->cidade->nome }}-{{ $contrato->oferta->cidade->estado->uf }}<br>
                    <br>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('ofertas.info',    ['id'=>$contrato->oferta->id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações da Oferta</i></a>
                </div>
            </div>

       
                    <br/>
                    <div class="col-md-12">

        <div class="box box-success box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-wechat"></i> Chat</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <div class="input-group input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat">Enviar!</button>
                                </span>
                             </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
             </div>
        </div>
     </div>
</div>


<!-- Modal Recusar Contrato -->
<div class="modal fade" id="myModalGerar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Gerar Contrato</h4>
      </div>
      <div class="modal-body">
        Atenção! Ao gerar o contrato, você fecha as definições do mesmo e envia para o contratante avaliar!<br/><br/>
        Esta ação impedirá quaisquer alterações no andamento da negociação até que o contratante tome uma decisão! Tem certeza que deseja contiuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <a href="{{ route('contratos.generate',    ['id'=>$contrato->id]) }}" class="btn btn-success"><i class="fa fa-chain"></i>  Gerar!</a>
      </div>
    </div>
  </div>
</div>
@endsection