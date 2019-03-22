@extends('adminlte::default')

@section('content')
<!-- START CUSTOM TABS -->
<div class="container-fluid ">
    <h3><i class="fa fa-ellipsis-v"></i> Interesses</h3>
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Propostas</a></li>
                <li><a href="#tab_2-2" data-toggle="tab">Interesses</a></li>


                </ul>
            </div>

            <div class="tab-content">

                <!-- Tab-1 -->
                <div class="tab-pane active" id="tab_1-1">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr >
                                    <th>ID</th>
                                    <th style="width: 150px;">Data</th>
                                    <th class="text-center">Interesse</th>
                                    <th class="text-center">Oferta</th>
                                    <th class="text-center">Necessidade</th>
                                </tr>
                            </thead>
                            @if(count($propostas) > 0)
                            <tbody>
                                @foreach($propostas as $p)
                                <tr>
                                    <td>#{{ $p->id}}</td>
                                    <td>{{ (new DateTime($p->data))->format('d/m/Y H:i:s') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('interesses.info',    ['id'=>$p->id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('ofertas.info',    ['id'=>$p->oferta_id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('necessidades.info',    ['id'=>$p->necessidade_id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$propostas->links()}}
                    </div>
                </div>


                <!-- Tab-1 -->
                <div class="tab-pane" id="tab_2-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr >
                                    <th>ID</th>
                                    <th style="width: 150px;">Data</th>
                                    <th class="text-center">Interesse</th>
                                    <th class="text-center">Oferta</th>
                                    <th class="text-center">Necessidade</th>
                                </tr>
                            </thead>
                            @if(count($interesses) > 0)
                            <tbody>
                                @foreach($interesses as $i)
                                <tr>
                                    <td>#{{ $i->id}}</td>
                                    <td>{{ (new DateTime($i->created_at))->format('d/m/Y H:i:s') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('interesses.info',    ['id'=>$i->id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('ofertas.info',    ['id'=>$i->oferta_id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('necessidades.info',    ['id'=>$i->necessidade_id]) }}" class="btn btn-info"><i class="fa fa-info-circle"> Informações</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif    
                        </table>
                    </div>
                    <div class="pull-right">
                        {{$interesses->links()}}
                    </div>
                </div>                




             </div>
        </div>
    </div>    
</div>   
@endsection