@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Suas Ofertas</h3>
        <hr/>

    {!! Form::open(['name'=>'form_name', 'route'=>'ofertas']) !!}
        <div >
            <div class="input-group">
                <input type="text" name="filtragem" class="form-control"
                style="width:100% !important;" placeholder="Pesquisa..."/>
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    {!! Form::close() !!}
    <hr/>
   
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            <hr/>
        @endif
        
        @if($ofertas->count() > 0)
        <div class="table-responsive">
       
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Preço (R$)</th>
                    <th>Unidade</th>
                    <th>Status</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ofertas as $oferta)
                    <tr>
                        <td>{{ $oferta->titulo }}</td>
                        <td>{{ $oferta->categoria->nome }}</td>
                        <td>{{number_format((float)$oferta->preco, 2, ',', '')}}</td>
                        <td>{{ $oferta->unidade }}</td>
                        @if($oferta->ativo == true)
                            <td>Ativa</td>
                        @else
                            <td>Desativa</td>
                        @endif
                        <td>
                            <a href="{{ route('ofertas.edit',    ['id'=>$oferta->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>

                            @if($oferta->ativo == true)
                                <a href="{{ route('ofertas.active',  ['id'=>$oferta->id]) }}" class="btn btn-info"><i class="fa fa-toggle-on"></i> Desativar</a>
                            @else
                                <a href="{{ route('ofertas.active',  ['id'=>$oferta->id]) }}" class="btn btn-info"><i class="fa fa-toggle-off"></i> Ativar</a>
                            @endif

                            <a href="#" onClick="return ConfirmaExclusao({{$oferta->id}})" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="pull-right">
             {{$ofertas->links()}}
        </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
                    <div class="panel-body text-center">
                        <h4>Nenhuma oferta cadastrada.</h4>
                        <a href="{{ url('/ofertas/create') }}" ><h4>Clique aqui para cadastrar!</h4></a>
                    </div>
                </div>
            @endif
        <div>
        <br/>
            <a href="{{ url('/ofertas/create') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>

    </div>
@endsection

@section("table-delete")
"ofertas"
@endsection