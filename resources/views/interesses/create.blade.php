@extends('adminlte::default')

@section('content')
    <div class="container">
        <h3><i class="fa fa-ellipsis-v"></i> Novo Interesse</h3>
        <hr/>
        {!! Form::open(['route' => ["interesses.store", $necessidade->id]]) !!}


            @if($errors->any())
            <div class="col-md-12">
                <ol class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li style="margin: 10px;">{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            <div class="row">

                <div class="col-sm-12 col-md-6">

                @if($pessoa)
                        <div class="form-group col-md-12">
                            {!! Form::label('email', 'E-mail:') !!}
                            {!! Form::email('email', $pessoa->user->email, ['class'=>'form-control', 'placeholder'=>'E-mail para contato']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('telefone', 'Telefone:') !!}
                            {!! Form::text('telefone', $pessoa->telefone, ['class'=>'form-control', 'placeholder' => 'Telefone para contato']); !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('celular', 'Celular:') !!}
                            {!! Form::text('celular', $pessoa->celular, ['class'=>'form-control', ]) !!}
    
                        </div>
                    @else

                    <div class="form-group col-md-12">
                            {!! Form::label('email', 'E-mail:') !!}
                            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'E-mail para contato']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('telefone', 'Telefone:') !!}
                            {!! Form::text('telefone', null, ['class'=>'form-control', 'placeholder' => 'Telefone para contato']); !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('celular', 'Celular:') !!}
                            {!! Form::text('celular', null, ['class'=>'form-control', 'placeholder'=>'Celular para contato']) !!}
    
                        </div>
                    @endif
                    
                    <div class="form-group col-md-12">
                        {!! Form::label('orcamento', 'Orçamento:') !!}
                        {!! Form::text('orcamento', null, ['class'=>'form-control', 'required', 'placeholder'=>'Ex.: R$ 400,00']) !!}
                    </div>

                    <div class="form-group col-md-12">
                    <a href="{{ route('necessidades.info',    ['id'=>$necessidade->id]) }}" class="btn btn-info form-control"><i class="fa fa-info-circle"> Informações da Necessidade</i></a>
                    </div>


                </div>


                <div class="col-sm-12 col-md-6">
                {!! Form::label('', 'Selecione uma oferta:') !!}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover"> 
                            <tbody>
                                @foreach($ofertas as $o)
                                    <tr>
                                        <td>{!! Form::radio('oferta_id', $o->id)!!}</td>    
                                        <td>{{$o->titulo}}</td>    
                                    </tr>
                                @endforeach
                                <tr>
                                    <td  colspan="2"><a href="{{ url('/ofertas/create') }}" class="btn btn-primary form-control"><i class="fa fa-plus"></i> Cadastrar</a></td>        
                                </tr>
                            </tbody>
                        </table>

                    <div class="pull-right">
                        {{$ofertas->links()}}
                    </div>
                    </div>


                    <div class="form-group col-md-12">
                        <br/>
                        {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
                        <a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>

            </div>


        {!! Form::close() !!}
    </div>
@endsection

@section('dyn_scripts')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script>
        $('#telefone').mask('(99) 9999-9999');
        $('#celular').mask('(99) 99999-9999');
    </script>

@endsection