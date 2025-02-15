<?php

namespace QueryBuilder\Manipulation;

use QueryBuilder\Expression\Criteria\TCriteria;

/**
 * classe TSqlInstruction
 * Esta classe provê os métodos em comum entre todas as instruções
 * SQL (SELECT, INSERT, DELETE E UPDATE)
 */
abstract class TSqlInstruction
{
    protected $sql; // armazena a instrucao SQL
    protected $criteria; // armazena o objeto criterio
    protected $table; // tabela no banco de dados.

    /**
     * Define o nome da tabela no banco de dados
     * @param string $table = tabela
     */
    final public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Retorna o nome da tabela
     */
    final public function getTable()
    {
        return $this->table;
    }

    /**
     * Define um criterio de selecao dos dados atraves da composicao de um objeto do tipo TCriteria
     * que oferece uma interface para definicao de criterios
     * 
     * @param TCriteria $criteria
     */

    public function setCriteria(TCriteria $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * Declarando o como abstract obrigando a sua implementacao nas classes filhas
     * Uma vez que seu comportamento sera distinto em cada uma delas, configurando polimorfismo.
     */
    abstract function getInstruction();

}