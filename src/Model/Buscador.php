<?php

namespace Alura\BuscadorDeCursos\Model;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;

    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url, string $seletor): array
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = (string) $resposta->getBody();

        $this->crawler->clear();
        $this->crawler->addHtmlContent($html);

        $elementos = $this->crawler->filter($seletor);

        $itens = [];
        foreach ($elementos as $elemento) {
            $itens[] = trim($elemento->textContent);
        }

        return $itens;
    }
}
