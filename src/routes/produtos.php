<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes
// ORM - > Object Relational Mapper (Mapeador de objeto Relacional);
// Illuminete -> é o motor da base de dados do Laravel
// Eloquent ORM


$app->group('/api/v1', function(){
    //Lista produto
    $this->get('/produtos/lista', function(Request $request, Response $response){
       
        $produtos = Produto::get();


        return $response->withJson($produtos);
    });
    //adiciona produto
    $this->post('/produtos/adiciona', function(Request $request, Response $response){
       
        $dados = $request->getParsedBody();
        $produto = Produto::create($dados);
        return $response->withJson($produto);
    }); 
    //Recupera produto para um determinado ID
    $this->get('/produtos/lista/{id}', function(Request $request, Response $response, $args){
       
        $produto = Produto::findOrFail($args['id']);


        return $response->withJson($produto);
    });

    //Atualiza produto para um determinado ID
    $this->put('/produtos/atualiza/{id}', function(Request $request, Response $response, $args){
       
        $dados = $request->getParsedBody();

        $produto = Produto::findOrFail($args['id']);
        $produto->update($dados);

        return $response->withJson($produto);
    });

    //Remove produto para um determinado ID
    $this->get('/produtos/remove/{id}', function(Request $request, Response $response, $args){
 
        $produto = Produto::findOrFail($args['id']);
        $produto->delete();

        return $response->withJson($produto);
    });

});
