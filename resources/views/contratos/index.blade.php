@extends('adminlte::default')

@section('content')
<!-- START CUSTOM TABS -->
<div class="container-fluid ">
    <h3><i class="fa fa-ellipsis-v"></i> Contratos</h3>
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Contratando - Em Andamento     <span class="pull-right badge bg-blue" style="margin-left:10px;">{{count($em_andamento_contratante)}}</span></a> </li>
                <li><a href="#tab_2-2" data-toggle="tab">Sendo Contratado - Em Andamento <span class="pull-right badge bg-blue" style="margin-left:10px;">{{count($em_andamento_contratado)}}</span></a></li>
                <li><a href="#tab_3-3" data-toggle="tab">Contratou <span class="pull-right badge bg-blue" style="margin-left:10px;">{{count($finalizados_contratou)}}</span></a></li>
                <li><a href="#tab_4-4" data-toggle="tab">Foi Contratado <span class="pull-right badge bg-blue" style="margin-left:10px;">{{count($finalizados_contratado)}}</span></a></li>
                
                </ul>
            </div>

            <div class="tab-content">

                <!-- Tab-1 -->
                <div class="tab-pane active" id="tab_1-1">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="width: 150px;">Data</th>
                                    <th>Oferta</th>
                                    <th>Status</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            @if(count($em_andamento_contratante) > 0)
                            <tbody>
                                @foreach($em_andamento_contratante as $ea)
                                <tr>
                                    <td>#{{ $ea->id}}</td>
                                    <td>{{ (new DateTime($ea->created_at))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $ea->oferta->titulo }}</td>
                                    @if($ea->data_gerado)
                                        <td>Aguardando Assinatura</td>
                                    @else
                                        <td>Em Definição</td>
                                    @endif
                                    <td>
                                    @if($ea->data_gerado)
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Visualizar</i></a>
                                    @else
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Definir</i></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$em_andamento_contratante->links()}}
                    </div>
                </div>

                <!-- Tab-2 -->
                <div class="tab-pane" id="tab_2-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="width: 150px;">Data</th>
                                    <th>Oferta</th>
                                    <th>Status</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            @if(count($em_andamento_contratado) > 0)
                            <tbody>
                                @foreach($em_andamento_contratado as $ea)
                                <tr>
                                    <td>#{{ $ea->id}}</td>
                                    <td>{{ (new DateTime($ea->created_at))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $ea->titulo }}</td>
                                    @if($ea->data_gerado)
                                        <td>Aguardando Assinatura</td>
                                    @else
                                        <td>Em Definição</td>
                                    @endif
                                    <td>
                                    @if($ea->data_gerado)
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Visualizar</i></a>
                                    @else
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Definir</i></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$em_andamento_contratado->links()}}
                    </div>
                </div>

                <!-- Tab-3 -->
                <div class="tab-pane" id="tab_3-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="width: 150px;">Data Assinatura</th>
                                    <th>Oferta</th>
                                    <th>Status</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            @if(count($finalizados_contratou) > 0)
                            <tbody>
                                @foreach($finalizados_contratou as $ea)
                                <tr>
                                    <td>#{{ $ea->id}}</td>
                                    <td>{{ (new DateTime($ea->data_assinado))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $ea->oferta->titulo }}</td>
                                    @if($ea->data_realizado)
                                        <td class="text-bold text-success">Realizado em {{(new DateTime($ea->data_realizado))->format('d/m/Y')}}</td>
                                    @else
                                        <td class="text-bold text-danger">Não Realizado</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Visualizar</i></a>
                                    @if($ea->data_realizado && $ea->avaliacao_nota == null)
                                        <a href="{{ route('contratos.score',    ['id'=>$ea->id]) }}" class="btn btn-warning"><i class="fa fa-star"> Avaliar</i></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$finalizados_contratou->links()}}
                    </div>
                </div>


                <!-- Tab-4 -->
                <div class="tab-pane" id="tab_4-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="width: 150px;">Data Assinatura</th>
                                    <th>Oferta</th>
                                    <th>Status</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            @if(count($finalizados_contratado) > 0)
                            <tbody>
                                @foreach($finalizados_contratado as $ea)
                                <tr>
                                    <td>#{{ $ea->id}}</td>
                                    <td>{{ (new DateTime($ea->created_at))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $ea->titulo }}</td>
                                    @if($ea->data_realizado)
                                        <td class="text-bold text-success">Realizado em {{ (new DateTime($ea->data_realizado))->format('d/m/Y')}}</td>
                                    @else
                                        <td class="text-bold text-danger">Não Realizado</td>
                                    @endif

                                    <td>
                                        <a href="{{ route('contratos.info',    ['id'=>$ea->id]) }}" class="btn btn-primary"><i class="fa fa-info-circle"> Visualizar</i></a>
                                    @if($ea->data_realizado == null)
                                         <button type="button" class="btn btn-success btRealizado" data-toggle="modal" data-target="#myModalRealizado" value="{{$ea->id}}"><i class="fa fa-check"></i> Realizado</a></button>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$finalizados_contratado->links()}}
                    </div>
                </div>


             </div>
        </div>
    </div>    
</div>

<!-- Modal Realizado -->
<div class="modal fade" id="myModalRealizado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Serviço Realizado!</h4>
      </div>
      <div class="modal-body">
        Atenção! A ação de definir o serviço como realizado é irreversível e habilitará a avaliação do serviço para o contratante,<br/><br/>
        Tem certeza que deseja contiuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" id="btnSim" class="btn btn-success"><i class="fa fa-check"> Sim</i></button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('dyn_scripts')
    <script>
        var x; 
        $('.btRealizado').click(function(e){
            x = $('.btRealizado').val();
        });

          $('#btnSim').click(function(){
              console.log("a");
            document.location.href = '/contratos/' + x + '/done'
        });
    </script>
@endsection