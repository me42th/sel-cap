<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user/{local?}', function($loc = 'Brasil'){

    //$query = "select funcionario.nome as FUNCIONARIO, funcionario.cidade as ORIGEM , '$local' as UNIDADE from funcionario join habilitacao on habilitacao.id_funcionario = funcionario.id join posto on habilitacao.id_posto = posto.id where (unix_timestamp(now()) - unix_timestamp(habilitacao.inicio)) / (60*60*24*30) >= 1 and posto.nome = 'Brasil' group by funcionario.id;";
    $query = "select funcionario.nome as FUNCIONARIO, funcionario.cidade as ORIGEM , '$loc' as UNIDADE from funcionario join habilitacao on habilitacao.id_funcionario = funcionario.id join posto on habilitacao.id_posto = posto.id where posto.nome = '$loc' group by funcionario.id;";
    $data = DB::select($query);
    $code = '201';
    if(count($data) === 0){
        $data = 'vazio';
        $code = '404';
    }
    return response()->json([
        'msg' => $data,
        'code' => $code
    ]);

});


