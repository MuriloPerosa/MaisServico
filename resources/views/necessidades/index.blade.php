@extends('adminlte::default')

@section('content')
    <div class="container-fluid ">
        <h3><i class="fa fa-ellipsis-v"></i> Suas Necessidades</h3>
        <hr/>
        {!! Form::open(['name'=>'form_name', 'route'=>'necessidades']) !!}
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
        
        @if($necessidades->count() > 0)
        <div class="table-responsive">
        <table class="table table-striped table-hover">
        </div>
            <thead>
                <tr>
                    <th style="width: 200px;">Título</th>
                    <th>Categoria</th>
                    <th style="width: 400px;">Descrição</th>
                    <th>Data Limite</th>
                    <th>Status</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($necessidades as $necessidade)
                    <tr>
                        <td>{{ $necessidade->titulo }}</td>
                        <td>{{ $necessidade->categoria->nome }}</td>
                        <td>{{ $necessidade->descricao }}</td>
                        <td>{{ (new DateTime($necessidade->data_limite))->format('d/m/Y') }}</td>
                        @if($necessidade->ativo == true)
                            <td>Ativa</td>
                        @else
                            <td>Desativa</td>
                        @endif
                        <td>
                            <a href="{{ route('necessidades.edit',    ['id'=>$necessidade->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>

                            @if($necessidade->ativo == true)
                                <a href="{{ route('necessidades.active',  ['id'=>$necessidade->id]) }}" class="btn btn-info"><i class="fa fa-toggle-on"></i> Desativar</a>
                            @else
                                <a href="{{ route('necessidades.active',  ['id'=>$necessidade->id]) }}" class="btn btn-info"><i class="fa fa-toggle-off"></i> Ativar</a>
                            @endif

                            <a href="#" onClick="return ConfirmaExclusao({{$necessidade->id}})" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading "><h3 class="text-bold text-center"><i class="text-success  fa fa-warning"></i> Atenção!</h3></div>
                    <div class="panel-body text-center">
                        <h4>Nenhuma necessidade cadastrada.</h4>
                        <a href="{{ url('/necessidades/create') }}" ><h4>Clique aqui para cadastrar!</h4></a>
                    </div>
                </div>
            @endif
        <div class="pull-right">
             {{$necessidades->links()}}
        </div>
        <div>
            <br/>
            <a href="{{ url('/necessidades/create') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>

    </div>
@endsection

@section("table-delete")
"necessidades"
@endsection