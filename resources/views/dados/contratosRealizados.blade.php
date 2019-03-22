@extends('adminlte::default')

@section('content')
<div class="container-fluid">


    <h3><i class="fa fa-ellipsis-v"></i> Serviços Realizados</h3>
    <hr/>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="text-center bg-blue"><h4>GERAL</h4></th>
                </tr>
                <tr>
                    <th class="text-center">Ano</th>
                    <th class="text-center">Serviços Realizados</th>
                    <th class="text-center">Valor Recebido</th>
                </tr>
            </thead>
            <tbody>
            @if(count($ano)>0)
                @foreach($ano as $a)
                    <tr>
                       <td class="text-center">{{$a->ano}}</td>
                       <td class="text-center">{{$a->cont}}</td>
                       <td class="text-center">R$ {{number_format((float)$a->valor, 2, ',', '')}}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td class="text-center text-bold">TOTAL</td>
                        <td class="text-center text-bold">{{$ContGeral}}</td>
                        <td class="text-center text-bold">R$ {{number_format((float)$SumGeral, 2, ',', '')}}</td>
                    </tr>
            @else
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        <br>
                        Não há dados para serem exibidos.
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <hr/>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="text-center bg-blue"><h4>POR PERÍODO</h4></th>
                </tr>
                <tr>
                    <th class="text-center">Período</th>
                    <th class="text-center">Serviços Realizados</th>
                    <th class="text-center">Valor Recebido</th>
                </tr>
            </thead>
            <tbody>
            @if(count($mes)>0)
                @foreach($mes as $m)
                    <tr>
                       <td class="text-center">{{$m->mes}} / {{$m->ano}}</td>
                       <td class="text-center">{{$m->cont}}</td>
                       <td class="text-center">R$ {{number_format((float)$m->valor, 2, ',', '')}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        <br>
                        Não há dados para serem exibidos.
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>


</div>



@endsection

@section('dyn_scripts')

@endsection