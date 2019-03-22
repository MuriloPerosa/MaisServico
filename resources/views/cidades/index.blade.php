@extends('adminlte::default')

@section('content')
    <div class="container-fluid">
        <h3><i class="fa fa-ellipsis-v"></i> Cidades</h3>
        <hr/>

    {!! Form::open(['name'=>'form_name', 'route'=>'cidades']) !!}
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
        
        @if($cidades->count() > 0)
        <div class="table-responsive">
       
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Estado</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cidades as $cid)
                    <tr>
                        <td>{{ $cid->id }}</td>
                        <td>{{ $cid->nome }}</td>
                        <td>{{ $cid->estado->uf }}</td>
                        <td>
                            <a href="{{ route('cidades.edit',    ['id'=>$cid->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                            <a href="#" onClick="return ConfirmaExclusao({{$cid->id}})" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="pull-right">
             {{$cidades->links()}}
        </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
                    <div class="panel-body text-center">
                        <h4>Nenhuma cidade cadastrada.</h4>
                        <a href="{{ url('/cidades/create') }}" ><h4>Clique aqui para cadastrar!</h4></a>
                    </div>
                </div>
            @endif
        <div>
        <br/>
            <a href="{{ url('/cidades/create') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>

    </div>
@endsection

@section("table-delete")
"cidades"
@endsection