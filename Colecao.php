<?php

class Colecao
{
    public function __construct(private array $colecao)
    {
    }

    public function __get(string|int $propriedade)
    {
        return $this->colecao[$propriedade]
            ?? throw new Exception("Propriedade '{$propriedade}' não encontrada.");
    }
    
    public function __toString()
    {
        return $this->colecao;
    }

    public function each(callable $callback)
    {
        foreach ($this->colecao as $key => $value) {
            if( $callback($key, $value) === false ){
                break;
            }
        }
        
        return $this;
    }

    public function map(callable $callback)
    {
        return new Colecao( array_map($callback, $this->colecao) );
    }

    public function valores()
    {
        return new Colecao( array_values($this->colecao) );
    }

    public function chaves()
    {
        return new Colecao( array_keys($this->colecao) );
    }

    public function diferenca(array $array)
    {
        return new Colecao( array_diff($array) ); 
    }

    public function primeiro()
    {
        $retorno = reset($this->colecao);
        
        return is_array($retorno) ? new Colecao($retorno) : $retorno;
    }

    public function ultimo()
    {
        $retorno = end($this->colecao);

        return is_array($retorno) ? new Colecao($retorno) : $retorno;
    }

    public function primeiraChave()
    {
        $retorno = array_key_first($this->colecao);

        return is_array($retorno) ? new Colecao($retorno) : $retorno;
    }

    public function ultimaChave()
    {
        $retorno = array_key_last($this->colecao);

        return is_array($retorno) ? new Colecao($retorno) : $retorno;
    }

    public function soma()
    {
        return array_sum($this->colecao);
    }




    // Modificam o array
    public function ordenar()
    {
        sort($this->colecao);

        return $this;
    }

    public function reverso()
    {
        $this->colecao = array_reverse($this->colecao);
                
        return $this;
    }

    public function incluir(mixed $item)
    {
        $this->colecao = array_push($this->colecao, $item);

        return $this;
    }
}