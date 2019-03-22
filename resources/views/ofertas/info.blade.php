@extends('adminlte::default')




@section('content')
      <h2>
      <i class="fa fa-ellipsis-v"></i> Oferta
            <small>#{{$oferta->id}}</small>
            <small class="pull-right">Data: {{ (new DateTime($oferta->created_at))->format('d/m/Y') }}</small>
      </h2>


  <!-- title row -->
  <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            {{$oferta->titulo}}
            <small class="pull-right"><i class="fa fa-line-chart"></i> {{number_format((float)$oferta->media_notas, 2, '.', '') }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>

    <div class="row ">
        <div class="col-sm-12 invoice-col">
            <strong>Descrição</strong><br>
            {{ $oferta->descricao}}<br/><br/>
        </div>
        @if($oferta->observacoes)
        <div class="col-sm-12 invoice-col">
            <strong>Obeservações</strong><br>
            {{ $oferta->observacoes}}<br/><br/>
        </div>
        @endif
    </div>

      
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>GERAL</strong><br><br>
            <strong>Usuário:</strong> {{ $oferta->user->name }}<br>
            <strong>Categoria:</strong> {{$oferta->categoria->nome}}<br>
            <strong>Cidade:</strong> {{$oferta->cidade->nome}} - {{$oferta->cidade->estado->uf}}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>CONTATO</strong><br><br>
            <strong>Telefone:</strong> {{$oferta->telefone}}<br>
            <strong>Celular:</strong> {{$oferta->celular}}<br>
            <strong>E-mail:</strong> {{ $oferta->email }}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>PREÇO</strong><br><br>
            <strong class="text-success">R$ {{number_format((float)$oferta->preco, 2, ',', '')}} / {{$oferta->unidade}}</strong><br><br>
            <a href="{{ route('contratos.fill',    ['id'=>$oferta->id]) }}" class="btn btn-primary col-sm-12 col-md-6 col-lg-4"> Contratar</a>
          </address>
        </div>
        <!-- /.col -->
        <br/>
        <br/>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Avaliações
          </h2>
        </div>
        <!-- /.col -->
      </div>
      @if(count($oferta->contratosAvaliados()) > 0) 
           <!-- Post -->
<div class="post clearfix">
 @foreach($oferta->contratosAvaliados() as $index=>$c)
  <div class="user-block">
  @if($c->avaliacao_nota< 10)
    <strong class="pull-left"><i class="fa fa-line-chart"></i> {{number_format((float)$c->avaliacao_nota, 2, '.', '')  }} </strong>
  @else
    <strong class="pull-left"><i class="fa fa-line-chart"></i> {{number_format((float)$c->avaliacao_nota, 1, '.', '')  }} </strong>
  @endif
    <span class="username">
    <b style="margin-left:3px;"> #{{$index+1}}</b> <strong class="text-success">{{$c->contratante()->name}}</strong> <small class="text-secondary"> {{ (new DateTime($c->update_at))->format('d/m/Y') }}</small> 
    </span>
    </div>
    <!-- /.user-block -->
    <p>{{$c->avaliacao_cmt}}</p>
      <hr/>
      @endforeach
  </div>
</div>

        <!-- /.col -->
      </div>
      @else
      <div class="col-sm-12">
        <div class="alert alert-success">
          <h4 class="text-center">Não há avaliações para esta oferta!</h4>
        </div>
      </div>
      @endif
@endsection

