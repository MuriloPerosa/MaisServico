
<div align="center">
    <h2><strong>Relatório Localização</strong></h2>
</div>

<table>
    <tr>
        <td><h4>Nome:</h4></td>
        <td>{{$cidade->nome}}</td>
        <td><br></td>
        <td><h4>Estado:</h5></td>
        <td>{{$cidade->estado->nome}}</td>

</table>

<br>

<table  border="1" style="border: 1px solid black; border-collapse: collapse;  margin: 0px auto;"> 
    <thead> 
        <tr>
            <th colspan="5" align="center"><h4>Dados Gerais:</h4></th>
        </tr>
        <tr>
            <th colspan="2" align="center">Ofertas</th>
            <th colspan="2" align="center">Necessidades</th>
            <th></th>            
        </tr>
        <tr>
            <th align="center">Ativas</th>
            <th align="center">Total</th>
            <th align="center">Ativas</th>
            <th align="center">Total</th>
            <th align="center">Usuários</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">{{$ofertasAtivas}}</td>
            <td align="center">{{$ofertasTotal}}</td>
            <td align="center">{{$necessidadesTotal}}</td>
            <td align="center">{{$necessidadesAtivas}}</td>
            <td align="center">{{$usersCount}}</td>
        </tr>
    </tbody>
</table>
<br>
<hr/>
<br>


    <table border="1" style="border: 1px solid black; border-collapse: collapse;  margin: 0px auto;">
        <thead> 
            <tr>
                <th colspan="3" align="center"><h4>Top 5 Ofertas (Avaliações):</h4></th>
            </tr>
            <tr>
                <th align="center">Oferta</th>
                <th align="center">Usuário</th>
                <th align="center">Nota</th>
            </tr>
        </thead>
        <tbody>
        @foreach($topOfertas as $to)
            <tr>
                <td align="center">{{$to->titulo}}</td>
                <td align="center">{{$to->user->name}}</td>
                <td align="center">{{$to->media_notas}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <hr/>
    <br>

    <table border="1" style="border: 1px solid black; border-collapse: collapse; margin: 0px auto;">
        <thead> 
            <tr>
                <th colspan="3" align="center"><h4>Top 5 Necessiades (Mais Recentes):</h4></th>
            </tr>
            <tr>
                <th align="center">Oferta</th>
                <th align="center">Usuário</th>
                <th align="center">Data</th>
            </tr>
        </thead>
        <tbody>
        @foreach($topNecessidades as $tn)
            <tr>
                <td align="center">{{$tn->titulo}}</td>
                <td align="center">{{$tn->user->name}}</td>
                <td align="center">{{ (new DateTime($tn->created_at))->format('d/m/Y') }}</td>
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
