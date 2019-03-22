@extends('adminlte::default')




@section('content')
      <h2>
      <i class="fa fa-ellipsis-v"></i> Necessidade
            <small>#{{$necessidade->id}}</small>
            <small class="pull-right">Data: {{ (new DateTime($necessidade->created_at))->format('d/m/Y') }}</small>
      </h2>


  <!-- title row -->
  <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            {{$necessidade->titulo}}
          </h2>
        </div>
        <!-- /.col -->
      </div>

    <div class="row ">
        <div class="col-sm-12 invoice-col">
            <strong>Descrição</strong><br>
            {{ $necessidade->descricao}}<br/><br/>
        </div>
        @if($necessidade->observacoes)
        <div class="col-sm-12 invoice-col">
            <strong>Obeservações</strong><br>
            {{ $necessidade->observacoes}}<br/><br/>
        </div>
        @endif
    </div>

      
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>GERAL</strong><br><br>
            <strong>Usuário:</strong> {{ $necessidade->user->name }}<br>
            <strong>Categoria:</strong> {{$necessidade->categoria->nome}}<br>
            <strong>Cidade:</strong> {{$necessidade->cidade->nome}} - {{$necessidade->cidade->estado->uf}}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>CONTATO</strong><br><br>
            <strong>Telefone:</strong> {{$necessidade->telefone}}<br>
            <strong>Celular:</strong> {{$necessidade->celular}}<br>
            <strong>E-mail:</strong> {{ $necessidade->email }}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>DATA LIMITE</strong><br><br>
            <strong class="text-danger">{{ (new DateTime($necessidade->data_limite))->format('d/m/Y') }}</strong><br><br>
            <a href="{{ route('interesses.create',    ['id'=>$necessidade->id]) }}" class="btn btn-primary col-sm-12 col-md-6 col-lg-4"> Tenho Interesse</a>
          </address>
        </div>
        <!-- /.col -->
        <br/>
        <br/>
      </div>
        <!-- /.col -->
      </div>
@endsection

