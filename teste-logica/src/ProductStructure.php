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
        for($i=0; $i<count(self::products); $i++){
            $newVar = explode("-", self::products[$i]);
            $camisa[$newVar[0]][$i] = $newVar[1];
        }

        return $camisa;
    }

    public function orderProducts($camisa): array
    {
        $valorAnterior =0; $novaCamisa = array();
        foreach($camisa as $cor => $tamanhos){
            foreach($tamanhos as $key => $tamanho){
                if(!isset($novaCamisa[$cor][$tamanho])){
                    $novaCamisa[$cor][$tamanho] = 0;
                }

                if($tamanho == $valorAnterior){
                    $novaCamisa[$cor][$tamanho] += 1;
                }else{
                    $novaCamisa[$cor][$tamanho] += 1;
                }

                $valorAnterior = $tamanho;
            }
        }

        return $novaCamisa;
    }
    
    public function make(): array
    {
        return $this->orderProducts($this->explodeData());;
    }
}