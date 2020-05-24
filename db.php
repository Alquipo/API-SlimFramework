<?php
if (PHP_SAPI != 'cli') {
   exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela= 'produtos';

$schema->dropIfExists($tabela);

//cria a tabela produtos
$schema->create($tabela, function($table){

    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->date('dt_criacao');

});

//Preencha a tabela
$db->table($tabela)->insert([
    'titulo' => 'Smartphone Motorola Moto G5 32GB Dual Chip',
    'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-Core 1.8GHZ 4G Câmera 12 + 5MP (Dual Traseira) - Índigo',
    'preco' => 899.00,
    'fabricante' => 'Motorola',
    'dt_criacao' => '2020-05-24'
]);

$db->table($tabela)->insert([
    'titulo' => 'Iphone X Cinza Espacial 64GB',
    'descricao' => 'Tela 5.8" IOS 12 4G WI-FI Câmera 12MP - APPLE',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'dt_criacao' => '2020-05-23'
]);



?>