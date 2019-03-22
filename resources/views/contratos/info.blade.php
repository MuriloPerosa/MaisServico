@extends('adminlte::default')




@section('content')

<h2>
    <i class="fa fa-ellipsis-v"></i> Contrato
        <small>#{{$contrato->id}}</small>
        <small class="pull-right">Data: {{ (new DateTime($contrato->data_gerado))->format('d/m/Y') }}</small>
</h2>

<!-- Oferta -->
<div class="row">
    <div class="col-xs-12">
      <h2 class="page-header"> Oferta</h2>
    </div>
</div>

<div class="row">

  <div class="col-md-12 invoice-col">
  <div class="row">
        <div class="col-md-6">
          <strong><h4>{{ $contrato->oferta->titulo}}</h4></strong>
        </div>
        <div class="col-md-6">
          <a href="{{ route('ofertas.info',    ['id'=>$contrato->oferta->id]) }}" class="btn btn-info pull-right"><i class="fa fa-info-circle"> Informações da Oferta</i></a>
        <div>
  </div>
  </div>

  <div class="col-md-12 invoice-col">
    <strong>Categoria: </strong> {{ $contrato->oferta->categoria->nome}}
  </div>
  <div class="col-sm-12 invoice-col">
    <br/>
    <strong>Descrição</strong><br>
    {{ $contrato->oferta->descricao}}<br/><br/>
  </div>
  @if($contrato->oferta->observacoes)
  <div class="col-sm-12 invoice-col">
    <strong>Observações</strong><br>
    {{ $contrato->oferta->observacoes}}<br/><br/>
  </div>
  @endif
</div>
<!-- / Oferta -->

<!-- Partes Envolvidas -->
<div class="row ">
    <div class="col-xs-12">
      <h2 class="page-header"> Partes Envolvidas</h2>
    </div>
</div>

<div class="row ">
  <div class="col-sm-4 invoice-col">
    <address>
        <strong>CONTRATANTE</strong><br/><br/>
        <strong>Nome:</strong> {{$contratante->name}}<br/>
        <strong>CPF:</strong> {{$contratante->pessoa->cpf}}<br/>
        <strong>RG:</strong> {{$contratante->pessoa->rg}}<br/>
        <strong>E-mail:</strong> {{$contratante->email}}<br/>
        <strong>Telefone:</strong> {{$contratante->pessoa->telefone}}<br/>
        <strong>Celular:</strong> {{$contratante->pessoa->celular}}<br/> 
      </address>
  </div>

    <div class="col-sm-4 invoice-col">
    <address>
        <strong>CONTRATADO</strong><br/><br/>
        <strong>Nome:</strong> {{$contrato->oferta->user->name}}<br/> 
        <strong>CPF:</strong> {{$contrato->oferta->user->pessoa->cpf}}<br/> 
        <strong>RG:</strong> {{$contrato->oferta->user->pessoa->rg}}<br/>
        <strong>E-mail:</strong> {{$contrato->oferta->user->email}}<br/>
        <strong>Telefone:</strong> {{$contrato->oferta->user->pessoa->telefone}}<br/>
        <strong>Celular:</strong> {{$contrato->oferta->user->pessoa->celular}}<br/>
      </address>
  </div>
</div>
<!-- Partes Envolvidas -->


<!-- Serviço -->
<div class="row ">
    <div class="col-xs-12">
      <h2 class="page-header"> Serviço</h2>
    </div>
</div>

<div class="row ">

  @if($contrato->oferta->observacoes)
  <div class="col-sm-12 invoice-col">
    <strong>Observações</strong><br>
    {{ $contrato->observacoes}}<br/><br/>
  </div>
  @endif

  <div class="col-sm-4 invoice-col">
    <address>
        <strong>GERAL</strong><br/><br/>
        <strong>Data Início:</strong>:</strong> {{(new DateTime($contrato->data_inicio))->format('d/m/Y H:i:s')}}<br/>
        <strong>Data Fim:</strong> {{(new DateTime($contrato->data_fim))->format('d/m/Y H:i:s')}}<br/>
        <strong>Valor Total:</strong> <b class="text-success">R$ {{number_format((float)$contrato->preco, 2, ',', '')}}</b><br/>
      </address>
  </div>

    <div class="col-sm-4 invoice-col">
    <address>
        <strong>ENDEREÇO</strong><br/><br/>
        <strong>Endereço:</strong> {{$contrato->endereco}}<br/> 
        <strong>Cidade:</strong> {{$contrato->cidade->nome}}<br/> 
        <strong>Estado:</strong> {{$contrato->cidade->estado->nome}}<br/>
      </address>
  </div>


  <div class="col-sm-4 invoice-col">
    <address>
        <strong>DATAS</strong><br/><br/>
        <strong>Início do Contato:</strong> {{ (new DateTime($contrato->created_at))->format('d/m/Y H:i:s') }}<br/> 
        <strong>Contrato Gerado:</strong> {{ (new DateTime($contrato->data_gerado))->format('d/m/Y H:i:s') }}<br/> 
        @if($contrato->data_assinatura)
        <strong>Contrato Assinado:</strong> {{ (new DateTime($contrato->data_assinatura))->format('d/m/Y H:i:s') }}<br/> 
        @else
        <strong>Contrato Assinado:</strong> Não Assinado<br/> 
        @endif
      </address>
  </div>
</div>


<!-- Serviço -->
@if($contrato->data_realizado)
<div class="row ">
    <div class="col-xs-12">
      <h2 class="page-header"> Status</h2>
    </div>
</div>

<div class="row ">
  <div class="col-sm-12 invoice-col">
 <strong>Data Realizado:</strong> {{ (new DateTime($contrato->data_realizado))->format('d/m/Y') }}<br/><br/>
  @if($contrato->avaliacao_nota)
    <strong>Nota: </strong>
    {{ $contrato->avaliacao_nota}}<br/><br/>
    <strong>Comentário: </strong><br/>
    {{ $contrato->avaliacao_cmt}}<br/><br/>
  @endif
  </div>


</div>
@endif
<div class="row ">
    <div class="col-xs-12">
      <h2 class="page-header"></h2>
    </div>
</div>

<div class="row">
  <div class="container-fluid">
      @if(Auth::user()->id === $contratante->id && $contrato->data_assinatura==null)
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalAssinar" ><i class="fa fa-pencil"></i> Assinar</a></button>
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalRecusar" ><i class="fa fa-times"></i> Recusar</a></button>
      @endif
      <a href="{{ url('/')}}" class="btn btn-danger">Cancelar</a>
  </div>
</div>
<!-- Modal Confirmar Assinatura -->
<div class="modal fade" id="myModalAssinar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assinar Contrato</h4>
      </div>
      <div class="modal-body">
        Atenção! Ao assinar o contrato, você concorda com a realização do serviço de acordo com o seu conteúdo!<br/><br/>
        Esta é uma ação irreversível! Tem certeza que deseja contiuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <a href="{{ route('contratos.sign',    ['id'=>$contrato->id]) }}" class="btn btn-success" id="#btnAssinar"><i class="fa fa-pencil"></i> Assinar!</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal Recusar Contrato -->
<div class="modal fade" id="myModalRecusar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Recusar Contrato</h4>
      </div>
      <div class="modal-body">
        Atenção! Ao recusar o contrato, você deixa claro que não concorda com a realização do serviço de acordo com o seu conteúdo!<br/><br/>
        Esta ação retornará a negociação para o estágio de definição! Tem certeza que deseja contiuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <a href="{{ route('contratos.redo',    ['id'=>$contrato->id]) }}" class="btn btn-warning"><i class="fa fa-times"></i> Recusar!</a>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- @section('dyn_scripts')

    <script>
        $(document).ready(function(){

            $('#btnAssinar').click()

        });
    </script>

@endsection -->