<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});



Route::group(['prefix' => 'emails', 'where' => ['id' => '[0-9]+']], function () {

    Route::post('emailsenha', ['as' => 'emails.emailsenha', 'uses' => 'EmailsController@emailsenha']);
});

Route::group(['prefix' => 'user', 'where' => ['id' => '[0-9]+']], function () {

    Route::get('redefinirsenha', ['as' => 'user.redefinirsenha', 'uses' => 'UserController@redefinirsenha']);
});



Route::group(['prefix' => 'ofertas', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('{id}/info', ['as' => 'ofertas.info', 'uses' => 'OfertasController@info']);
});


Route::group(['prefix' => 'necessidades', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('{id}/info', ['as' => 'necessidades.info', 'uses' => 'NecessidadesController@info']);
});



Route::group(['prefix' => 'search', 'where' => ['id' => '[0-9]+', 'cidade_id' => '[0-9]+', 'tipo_id' => '[0-9]+', 'categoria_id' => '[0-9]+', 'ordenacao_id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'search.index', 'uses' => 'SearchController@index']);
    // Route::post ('result',       ['as'=>'search.result',    'uses'=>'SearchController@result']);
    Route::post('form', ['as' => 'search.form', 'uses' => 'SearchController@index']);
    Route::get('/{cidade_id}/{tipo_id}/{categoria_id}/{ordenacao_id}/result', ['as' => 'search.result', 'uses' => 'SearchController@result']);
});

Route::group(['prefix' => 'cidades', 'where' => ['id_estado' => '[0-9]+']], function () {
    Route::get('{id_estado}/get', 'CidadesController@byEstado');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'dados', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('contratosRealizados', ['as' => 'dados.contratosRealizados', 'uses' => 'DadosController@contratosRealizados']);
  });


    Route::group(['prefix' => 'user', 'where' => ['id' => '[0-9]+']], function () {
        Route::put('update', ['as' => 'user.update', 'uses' => 'UserController@update']);
        Route::put('updatepassword', ['as' => 'user.updatepassword', 'uses' => 'UserController@updatepassword']);
        Route::get('edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
        Route::get('password', ['as' => 'user.password', 'uses' => 'UserController@password']);
    });

    Route::group(['prefix' => 'cidades', 'where' => ['id_estado' => '[0-9]+']], function () {
        Route::any('', ['as' => 'cidades', 'uses' => 'CidadesController@index']);
        Route::get('create', ['as' => 'cidades.create', 'uses' => 'CidadesController@create']);
        Route::get('{id_estado}', 'CidadesController@byEstado');
        Route::post('store', ['as' => 'cidades.store', 'uses' => 'CidadesController@store']);
        Route::get('{id}/destroy', ['as' => 'cidades.destroy', 'uses' => 'CidadesController@destroy']);
        Route::get('{id}/edit', ['as' => 'cidades.edit', 'uses' => 'CidadesController@edit']);
        Route::put('{id}/update', ['as' => 'cidades.update', 'uses' => 'CidadesController@update']);

    });

    Route::group(['prefix' => 'categorias', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('', ['as' => 'categorias', 'uses' => 'CategoriasController@index']);
        Route::get('delete', ['as' => 'categorias.delete', 'uses' => 'CategoriasController@delete']);
        Route::get('{id}/destroy', ['as' => 'categorias.destroy', 'uses' => 'CategoriasController@destroy']);
        Route::get('{id}/edit', ['as' => 'categorias.edit', 'uses' => 'CategoriasController@edit']);
        Route::post('store', ['as' => 'categorias.store', 'uses' => 'CategoriasController@store']);
        Route::put('{id}/update', ['as' => 'categorias.update', 'uses' => 'CategoriasController@update']);
        Route::get('createmaster', ['as' => 'categorias.createmaster', 'uses' => 'CategoriasController@createmaster']);
        Route::post('masterdetail', ['as' => 'categorias.masterdetail', 'uses' => 'CategoriasController@masterdetail']);


    });



    Route::group(['prefix' => 'ofertas', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('', ['as' => 'ofertas', 'uses' => 'OfertasController@index']);
        Route::get('create', ['as' => 'ofertas.create', 'uses' => 'OfertasController@create']);
        Route::get('{id}/active', ['as' => 'ofertas.active', 'uses' => 'OfertasController@active']);
        Route::get('{id}/destroy', ['as' => 'ofertas.destroy', 'uses' => 'OfertasController@destroy']);
        Route::get('{id}/edit', ['as' => 'ofertas.edit', 'uses' => 'OfertasController@edit']);
        Route::put('{id}/update', ['as' => 'ofertas.update', 'uses' => 'OfertasController@update']);
        Route::post('store', ['as' => 'ofertas.store', 'uses' => 'OfertasController@store']);
    });

    Route::group(['prefix' => 'necessidades', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('', ['as' => 'necessidades', 'uses' => 'NecessidadesController@index']);
        Route::get('create', ['as' => 'necessidades.create', 'uses' => 'NecessidadesController@create']);
        Route::get('{id}/active', ['as' => 'necessidades.active', 'uses' => 'NecessidadesController@active']);
        Route::get('{id}/destroy', ['as' => 'necessidades.destroy', 'uses' => 'NecessidadesController@destroy']);
        Route::get('{id}/edit', ['as' => 'necessidades.edit', 'uses' => 'NecessidadesController@edit']);
        Route::put('{id}/update', ['as' => 'necessidades.update', 'uses' => 'NecessidadesController@update']);
        Route::post('store', ['as' => 'necessidades.store', 'uses' => 'NecessidadesController@store']);

    });

    Route::group(['prefix' => 'contratos', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['as' => 'contratos', 'uses' => 'ContratosController@index']);
        Route::get('{id}/fill', ['as' => 'contratos.fill', 'uses' => 'ContratosController@fill']);
        Route::get('{id}/edit', ['as' => 'contratos.edit', 'uses' => 'ContratosController@edit']);
        Route::get('{id}/generate', ['as' => 'contratos.generate', 'uses' => 'ContratosController@generate']);
        Route::get('{id}/info', ['as' => 'contratos.info', 'uses' => 'ContratosController@info']);
        Route::get('{id}/sign', ['as' => 'contratos.sign', 'uses' => 'ContratosController@sign']);
        Route::get('{id}/redo', ['as' => 'contratos.redo', 'uses' => 'ContratosController@redo']);
        Route::get('{id}/done', ['as' => 'contratos.done', 'uses' => 'ContratosController@done']);
        Route::get('{id}/score', ['as' => 'contratos.score', 'uses' => 'ContratosController@score']);
        Route::put('{id}/save', ['as' => 'contratos.save', 'uses' => 'ContratosController@save']);
        Route::put('{id}/setscore', ['as' => 'contratos.setscore', 'uses' => 'ContratosController@setscore']);
    });

    Route::group(['prefix' => 'interesses', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['as' => 'interesses', 'uses' => 'InteressesController@index']);
        Route::get('{id}/create', ['as' => 'interesses.create', 'uses' => 'InteressesController@create']);
        Route::get('{id}/info', ['as' => 'interesses.info', 'uses' => 'InteressesController@info']);
        Route::post('{id}/store', ['as' => 'interesses.store', 'uses' => 'InteressesController@store']);     
    
    });


    Route::group(['prefix' => 'pdf', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('{id}/localizacao', ['as' => 'pdf', 'uses' => 'PdfController@localizacao']);
        Route::get('{id}/categoria', ['as' => 'pdf', 'uses' => 'PdfController@categoria']);
        Route::get('{id}/servicos', ['as' => 'pdf', 'uses' => 'PdfController@servicos']);
    });

    Route::group(['prefix' => 'relatorios', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('localizacao', ['as' => 'relatorios.localizacao', 'uses' => 'RelatoriosController@localizacao']);
        Route::get('categoria', ['as' => 'relatorios.categoria', 'uses' => 'RelatoriosController@categoria']);
        Route::get('servicosAno', ['as' => 'relatorios.servicosAno', 'uses' => 'RelatoriosController@servicosAno']);
        
        Route::post('categoriaPost', ['as' => 'relatorios.categoriaPost', 'uses' => 'RelatoriosController@categoriaPost']);
        Route::post('localizacaoPost', ['as' => 'relatorios.localizacaoPost', 'uses' => 'RelatoriosController@localizacaoPost']);
        Route::post('servicosAnoPost', ['as' => 'relatorios.servicosAnoPost', 'uses' => 'RelatoriosController@servicosAnoPost']);
        
    });
    
    Route::group(['prefix' => 'palavras', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('', ['as' => 'palavras', 'uses' => 'PalavrasChaveController@index']);
        Route::get('create', ['as' => 'palavras.create', 'uses' => 'PalavrasChaveController@create']);
        Route::get('{id}/destroy', ['as' => 'palavras.destroy', 'uses' => 'PalavrasChaveController@destroy']);
        Route::get('{id}/edit', ['as' => 'palavras.edit', 'uses' => 'PalavrasChaveController@edit']);
        Route::put('{id}/update', ['as' => 'palavras.update', 'uses' => 'PalavrasChaveController@update']);
        Route::post('store', ['as' => 'palavras.store', 'uses' => 'PalavrasChaveController@store']);
    });

    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

