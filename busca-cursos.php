<?php

require 'vendor/autoload.php';

use Alura\BuscadorDeCursos\Model\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$cliente = new Client(['base_uri' => 'https://books.toscrape.com']);
$crawler = new Crawler();


$buscador = new Buscador($cliente, $crawler);
$livros = $buscador->buscar('https://books.toscrape.com', 'article.product_pod h3 a');

foreach ($livros as $livro) {
    echo $livro . PHP_EOL;
}
