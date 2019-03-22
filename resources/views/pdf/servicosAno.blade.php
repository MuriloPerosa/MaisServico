
<div align="center">
    <h2><strong>Relatório Serviços Realizados no Ano</strong></h2>
</div>

<table>
    <tr>
        <td><h4>Ano:</h4></td>
        <td>{{$ano}}</td>
        <td><br></td>
</table>

<br>

<table  border="1" style="border: 1px solid black; border-collapse: collapse;  margin: 0px auto;"> 
    <thead> 
        <tr>
            <th colspan="7" align="center"><h4>Serviços Realizados em {{$ano}}</h4></th>
        </tr>
        <tr>
            <th align="center">Contrato</th>
            <th align="center">Oferta</th>
            <th align="center">Preço (R$)</th>
            <th align="center">Contratante</th>
            <th align="center">Contratado</th>
            <th align="center">Cidade</th>
            <th align="center">Data< Realizado/th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicos as $s)
        <tr>
            <td align="center">{{$s->id}}</td>
            <td align="center">{{$s->oferta->titulo}}</td>
            <td align="center">{{number_format((float)$s->preco, 2, ',', '') }}</td>
            <td align="center">{{$s->contratante()->name}}</td>
            <td align="center">{{$s->oferta->user->name}}</td>
            <td align="center">{{$s->cidade->nome}}-{{$s->cidade->estado->uf}}</td>
            <td align="center">{{ (new DateTime($s->data_realizado))->format('d/m/Y H:m:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    <br>
    <br>
    <br>
    <br>
    <hr>
    <div align="center">
        Relatório gerado em: {{ (new DateTime())->format('d/m/Y H:m:s') }}
    </div>
