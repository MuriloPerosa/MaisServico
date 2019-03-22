@extends('adminlte::default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3 class="text-bold"><i class="fa fa-ellipsis-v"></i> Bem-Vindo(a), {{Auth::user()->name}}! Aqui estão algumas sugestões para você! :)</h3>
    <hr/>
    </div>
    <div class="row">
    <div class="col-sm-12 col-md-6" >
    @if($ofertas->count() > 0)
    <ul class="timeline">
        <!-- timeline time label -->
        <li class="time-label">
            <span class="bg-blue">
                Principais Ofertas para {{Auth::user()->pessoa->cidade->nome}} - {{Auth::user()->pessoa->cidade->estado->uf}} 
            </span>
        </li>
            @foreach($ofertas as $index=>$o)
            <li>
                <!-- timeline icon -->
                <i class="fa fa-hashtag bg-green"></i>
                <div class="timeline-item"   style="height:180px;">
                    <h3 class="timeline-header"><a href="{{ route('ofertas.info',    ['id'=>$o->id]) }}" class="text-primary">{{$index+1}}ª {{$o->titulo}}</a></h3>

                    <div class="timeline-body">
                        {{$o->descricao}}<br/><br/>
                        @if($o->media_notas != null)
                            <strong>Nota: </strong> {{number_format((float)$o->media_notas, 2, '.', '')  }}                       
                        @else
                            <strong>Nota: </strong> Sem Avaliações                       
                        @endif 
                        <br/>
                            <strong>Usuário: </strong>{{$o->user->name}}<br/>
                    </div>
                </div>
            </li>
            @endforeach
       </ul>
            @else
                <div style="background-color: #5AC06F;">
                    <br/>
                    <br/>
                    <h3 style="color:white;" class="text-center">Nenhuma recomendação de oferta disponível para você!</h3>
                    <br/>
                    <br/>

                </div>
            @endif


        </div>

        <div class="col-sm-12 col-md-6" >

        @if($necessidades->count() > 0)
                <!-- /.box-header -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-blue">
                                Principais Necessidades para {{Auth::user()->pessoa->cidade->nome}} - {{Auth::user()->pessoa->cidade->estado->uf}} 
                            </span>
                        </li>
                            @foreach($necessidades as $index=>$o)
                            <li >
                                <!-- timeline icon -->
                                <i class="fa fa-hashtag bg-green"></i>
                                <div class="timeline-item" style="height:180px;">
                                    <h3 class="timeline-header"><a href="{{ route('necessidades.info',    ['id'=>$o->id]) }}" class="text-primary">{{$index+1}}ª {{$o->titulo}}</a></h3>

                                    <div class="timeline-body">
                                        {{$o->descricao}}<br/><br/>
                                            <strong>Data Limite: </strong> {{ (new DateTime($o->data_limite))->format('d/m/Y') }}                       
                                        <br/>
                                            <strong>Usuário: </strong>{{$o->user->name}}<br/>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>
            </div>
            <!-- /.box -->
            </div>
            @else
                <div style="background-color: #5AC06F;">
                    <br/>
                    <br/>
                    <h3 style="color:white;" class="text-center">Nenhuma recomendação de necessidade disponível para você!</h3>
                    <br/>
                    <br/>

                </div>
            @endif
        </div>        
    </div>

@endsection
