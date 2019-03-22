@extends('adminlte::default')

@section('content')
    <div class="container-fluid">

        <h3><i class="fa fa-ellipsis-v"></i> Palavras-Chave</h3>
        <hr/>

        {!! Form::open(['name'=>'form_name', 'route'=>'palavras']) !!}
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


        @if($palavras->count() === 0)
        <div class="panel panel-default">
            <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
            <div class="panel-body text-center">
                <h4>Nenhuma palavra-chave cadastrada.</h4>
                <a href="{{ url('/palavras/create') }}" ><h4>Clique aqui para cadastrar!</h4></a>
            </div>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover  table-striped" id="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col"  class="text-center">#</th>
                    <th scope="col"  class="text-center">Palavra</th>
                    <th scope="col"  class="text-center">...</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($palavras as $palavra)
                        <tr>
                            <td class="text-center">{{ $palavra->id }}</td>
                            <td class="text-center">{{ $palavra->palavra }}</td>
                            <td class="text-center">
                            <a href="{{ route('palavras.edit',    ['id'=>$palavra->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                            <a href="#" onClick="return ConfirmaExclusao({{$palavra->id}})" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a><td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pull-right">
                {{$palavras->links()}}
           </div>
        @endif
        <div>
            <br/>
            <a href="{{ url('/palavras/create') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
        </div>


        
    </div>

@endsection

@section("table-delete")
"palavras"
@endsection
