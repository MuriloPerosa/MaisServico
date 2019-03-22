@extends('adminlte::default')

@section('content')
    <div class="container-fluid">

        <h3><i class="fa fa-ellipsis-v"></i> Categorias</h3>
        <hr/>

        {!! Form::open(['name'=>'form_name', 'route'=>'categorias']) !!}
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
        @endif


        @if($categorias->count() === 0)
        <div class="panel panel-default">
            <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
            <div class="panel-body text-center">
                <h4>Nenhuma categoria cadastrada.</h4>
                <a href="{{ url('/categorias/create') }}" ><h4>Clique aqui para cadastrar!</h4></a>
            </div>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover  table-striped" id="table">
            <!-- <caption>Total: {{ $categorias->count() }}</caption> -->
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Palavras-Chave</th>
                    <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->descricao }}</td>
                            <td>
                                @foreach( $categoria->categoria_palavras as $cp)
                                    <ul><li>{{$cp->palavra->palavra}}</li></ul>
                                @endforeach     
                        </td>
                            <td>
                            <a href="{{ route('categorias.edit',    ['id'=>$categoria->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                            <a href="#" onClick="return ConfirmaExclusao({{$categoria->id}})" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a><td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pull-right">
                {{$categorias->links()}}
           </div>
        @endif
        <div>
            <br/>
            <a href="{{ url('/categorias/createmaster') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
        </div>


        
    </div>

@endsection

@section("table-delete")
"categorias"
@endsection
