<?php
namespace App;

class ProductStructure
{
    const products = [
        "preto-PP",
        "preto-M",
        "preto-G",
        "preto-GG",
        "preto-GG",
        "branco-PP",
        "branco-G",
        "vermelho-M",
        "azul-XG",
        "azul-XG",
        "azul-XG",
        "azul-P"
    ];

    public function explodeData(): array
    {
        foreach(self::products as $i => $product){
            $produto = explode("-", $product);
            $camisa[$produto[0]][$i] = $produto[1];
        }

        return $camisa;
    }

    public function orderProducts($camisa): array
    {
        $novaCamisa = array();
        foreach($camisa as $cor => $tamanhos){
            foreach($tamanhos as $tamanho){
                if(!isset($novaCamisa[$cor][$tamanho])) $novaCamisa[$cor][$tamanho] = 0;

                $novaCamisa[$cor][$tamanho] += 1;
            }
        }

        return $novaCamisa;
    }
    
    public function make(): array
    {
        return $this->orderProducts($this->explodeData());
    }
}