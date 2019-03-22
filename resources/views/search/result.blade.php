
@extends('adminlte::default')


@section('content')


<!-- /.col -->
  <div class="box-body">
  <div class="table-responsive">

    @if($hasResult == false)
        <div class="panel panel-default">
              <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
            <div class="panel-body text-center">
                <h4>Nenhum resultado encontrado.</h4>
                <h4>Categoria: {{ $categoria->nome}} | Cidade: {{ $cidade->nome}}-{{$cidade->estado->uf}}</h4>
                <a href="{{ url('/search') }}" ><h4>Clique aqui para fazer outra pesquisa!</h4></a>
            </div>
        </div>
    @else
    <div class="table-responsive">
      <table class="table table-stripped">
        <tr>
          <th><b><i class="fa fa-search"></i> Resultado da Pesquisa</b></th>
          <th class="text-right">Categoria: {{ $categoria->nome }}</th>
          <th class="text-right">Cidade: {{ $cidade->nome }}-{{ $cidade->estado->uf }}</th>
          <th class="text-right"><b>Ordenação: {{ $ordenacao }}</b></th>
          <th class="text-right"><b>Tipo: {{ $tipo }}</b></th>
        </tr>
        <tr>
          <td colspan="5"><br/></td>
        </tr>


        @if($ofertas)
              @foreach($ofertas as $oferta)
                <tr>
                  <td class colspan="5" >
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-hashtag"></i> {{ $oferta->titulo }}</h3>
                      <h3 class="box-title pull-right" style="margin-right:50px;"><i class="fa fa-user" ></i> {{ $oferta->user->name }}</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                  <b>Descrição:</b> {{$oferta->descricao}}
                                </div>
                            </div>

                            <br/>  

                            <div class="row">
                              <div class="col-lg-2">
                                <b>Por:</b><br/> {{$oferta->user->name}}
                              </div>
                              <div class="col-lg-2">
                                @if($oferta->media_notas < 10 && $oferta->avaliacao_media_notasnota > 0)
                                  <b>Avaliação: </b> <br/>{{number_format((float)$oferta->media_notas, 2, '.', '')  }}/10 
                                @elseif($oferta->media_notas === null) 
                                <b>Avaliação: </b> <br/><b class="text-danger">Sem Avaliações</b> 
                                @elseif($oferta->media_notas === 0)
                                <b>Avaliação: </b> <br/>0/10 
                                @else
                                  <b>Avaliação: </b> <br/>10/10 
                                @endif
                              </div>
                              <div class="col-lg-2">
                                <b>Preço:</b> <br/>R$ {{number_format((float)$oferta->preco, 2, ',', '')}}
                              </div>
                              <div class="col-lg-2">
                                <b>Unidade:</b> <br/>{{$oferta->unidade}} 
                              </div>
                            </div>

                        @if($oferta->observacoes)
                            <br/>
                            <div class="row">
                                <div class="col-lg-12">
                                  <b>Observações:</b>
                                  <p>{{$oferta->observacoes}}</p>
                                </div>
                            </div>
                        @endif
                            <br/>
                            <div class="row">
                                <div class="col-lg-4">
                                  <a href="{{ route('ofertas.info',    ['id'=>$oferta->id]) }}" class="btn btn-primary">Ver Detalhes</a>
                                </div>                       
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  </td>
                </tr> 
              @endforeach
        @elseif($necessidades)
          @foreach($necessidades as $necessidade)
                  <tr>
                    <td class colspan="5" >
                    <div class="box box-success box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hashtag"></i> {{ $necessidade->titulo }}</h3>
                        <h3 class="box-title pull-right" style="margin-right:50px;"><i class="fa fa-user" ></i> {{ $necessidade->user->name }}</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="container">
                              <div class="row">
                                  <div class="col-lg-12">
                                    <b>Descrição:</b> 
                                    <p>{{$necessidade->descricao}}</p>
                                  </div>
                              </div>

                              
                        @if($necessidade->observacoes)
                            <div class="row">
                                <div class="col-lg-12">
                                  <b>Observações:</b>
                                  <p>{{$necessidade->observacoes}}</p>
                                </div>
                            </div>
                        @endif

                              <div class="row">
                                <div class="col-lg-2">
                                  <b>Por:</b> {{$necessidade->user->name}}
                                </div>
                              </div>
                              <br/>

                              <br/>
                              <div class="row">
                                  <div class="col-lg-4">
                                    <a href="{{ route('necessidades.info',    ['id'=>$necessidade->id]) }}" class="btn btn-primary">Ver Detalhes</a>
                                  </div>                       
                              </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    </td>
                  </tr> 
              @endforeach
        @endif
      </table>
    </div>
  </div>
  </div>

  @if($ofertas)
    <div class="pull-right">
      {{$ofertas->links()}}
    </div>
  @elseif($necessidades)
  <div class="pull-right">
      {{$necessidades->links()}}
    </div>
  @endif
@endif

        
  </div>


@endsection

@section('dyn_scripts')


@endsection