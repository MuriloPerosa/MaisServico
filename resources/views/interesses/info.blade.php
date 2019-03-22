@extends('adminlte::default')

@section('content')

<h2>
    <i class="fa fa-ellipsis-v"></i> Interesse
        <small>#{{$interesse->id}}</small>
        <small class="pull-right">Data: {{ (new DateTime($interesse->created_at))->format('d/m/Y') }}</small>
</h2>

<!-- Geral -->
<div class="row">
    <div class="col-xs-12">
      <h2 class="page-header"> Geral</h2>
    </div>
</div>

<div class="row">


  <div class="col-md-12 col-lg-4 invoice-col">
    <strong>E-mail: </strong> {{ $interesse->email}}<br/>
    <strong>Telefone: </strong> {{ $interesse->telefone}}<br/>
    <strong>Celular: </strong> {{ $interesse->celular}}<br/>
  </div>
  <div class="col-sm-12 col-lg-4 invoice-col">
    <br/>
    <strong class="text-success">Orçamento:</strong>
    {{ $interesse->orcamento}}<br/><br/>
  </div>

</div>
<!-- / Gera -->

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
          <strong><h4>{{ $interesse->oferta->titulo}}</h4></strong>
        </div>
        <div class="col-md-6">
          <a href="{{ route('ofertas.info',    ['id'=>$interesse->oferta->id]) }}" class="btn btn-info pull-right"><i class="fa fa-info-circle"> Informações da Oferta</i></a>
        <div>
  </div>
  </div>

  <div class="col-sm-12 invoice-col">
    <br/>
    <strong>Descrição</strong><br>
    {{ $interesse->oferta->descricao}}<br/><br/>
  </div>
  @if($interesse->oferta->observacoes)
  <div class="col-sm-12 invoice-col">
    <strong>Observações</strong><br>
    {{ $interesse->oferta->observacoes}}
  </div>
  @endif
  <div class="col-md-12 invoice-col">
    <strong>Usuário: </strong> {{ $interesse->oferta->user->name}}<br/>
  </div>

  <div class="col-md-12 invoice-col">
    <strong>Categoria: </strong> {{ $interesse->oferta->categoria->nome}}<br/><br/>
  </div>
</div>
<!-- / Oferta -->


<!-- Necessidade -->
<div class="row">
    <div class="col-xs-12">
      <h2 class="page-header"> Oferta</h2>
    </div>
</div>

<div class="row">

  <div class="col-md-12 invoice-col">
  <div class="row">
        <div class="col-md-6">
          <strong><h4>{{ $interesse->necessidade->titulo}}</h4></strong>
        </div>
        <div class="col-md-6">
          <a href="{{ route('necessidades.info',    ['id'=>$interesse->necessidade->id]) }}" class="btn btn-info pull-right"><i class="fa fa-info-circle"> Informações da Necessidade</i></a>
        <div>
  </div>
  </div>

  <div class="col-sm-12 invoice-col">
    <br/>
    <strong>Descrição</strong><br>
    {{ $interesse->necessidade->descricao}}<br/><br/>
  </div>
  @if($interesse->oferta->observacoes)
  <div class="col-sm-12 invoice-col">
    <strong>Observações</strong><br>
    {{ $interesse->necessidade->observacoes}}
  </div>
  @endif
  <div class="col-md-12 invoice-col">
    <strong>Usuário: </strong> {{ $interesse->necessidade->user->name}}<br/>
  </div>

  <div class="col-md-12 col-lg-4 invoice-col">
    <strong>Categoria: </strong> {{ $interesse->necessidade->categoria->nome}}<br/><br/>
  </div>

  
  <div class="col-md-12 col-lg-4 invoice-col">
  <strong>Data Limite: </strong><strong class="text-danger">{{ (new DateTime($interesse->necessidade->data_limite))->format('d/m/Y') }}</strong><br><br>
  </div>
</div>
<!-- / Necessidade -->



<div class="row">
  <div class="container-fluid">
      <a href="{{ url('/')}}" class="btn btn-danger">Cancelar</a>
  </div>
</div>
  
@endsection

