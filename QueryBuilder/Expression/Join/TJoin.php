<?php

namespace QueryBuilder\Expression\Join;

use Exception;

/**
 * Classe responsavel por montar os JOINS necessarios.
 */
final class TJoin
{
    private $joins = [];

    /**
     * Metodo responsável por adicionar JOINs.
     * 
     * @param string $type;
     * @param array $paramsJoin = ["tables" => [
    *                                  "clientes",
    *                                  "pedidos"
    *                              ],
    *                              "operator" => "=",
    *                              "columns" => [
    *                                  "id",
    *                                  "cliente_id"
    *                              ]
    *                             ];
     */
    public function add(string $type, array $paramsJoin)
    {
        if (isset($paramsJoin)) {
            $this->joins[] = [
                "type" => strtoupper($type),
                "table_join" => $paramsJoin["tables"][0],
                "table_select" => $paramsJoin["tables"][1],
                "operator" => $paramsJoin["operator"],
                "columns" => $paramsJoin["columns"]
            ];
        } else {
            throw new Exception("O segundo parâmetro não pode estar vazio e precisa seguir a estrutura da documentação!");
        }
    }

    public function dump(): string
    {
        if (empty($this->joins)) {
            return '';
        }

        $result = [];
        foreach ($this->joins as $join) {
            $result[] = " {$join['type']} JOIN {$join['table_join']} ON {$join['table_join']}.{$join['columns'][0]} {$join['operator']} {$join['table_select']}.{$join['columns'][1]}";
        }
        return implode(' ', $result);
    }
}
