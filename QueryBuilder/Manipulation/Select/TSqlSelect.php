<?php

namespace QueryBuilder\Manipulation\Select;

use QueryBuilder\Expression\Join\TJoin;
use QueryBuilder\Manipulation\TSqlInstruction;

/**
 * Essa classe prove meios de manipular instrucoes SELECT
 */
final class TSqlSelect extends TSqlInstruction
{
    private $columns; // array de colunas a serem retornadas

    public function __construct(
        private TJoin $join = new TJoin()
    )
    {}

    /**
     * Adiciona uma coluna a ser retornada pelo SELECT
     */
    public function addColumn($column)
    {
        if(!empty($column)){
            $this->columns[] = $column;
        }
    }

    public function join(string $type, $paramsJoin)
    {
        $this->join->add($type, $paramsJoin);
    }

    private function columnsIsEmpty()
    {
        return !isset($this->columns);
    }

    private function mountInstruction()
    {
        $this->sql = 'SELECT ';

        if (!$this->columnsIsEmpty()) {
            $this->sql .= implode(', ', $this->columns);
        } else {
            $this->sql .= "*";
        }
        $this->sql .= ' FROM ' . $this->table;

        if($this->join){
            $this->sql .= $this->join->dump();
        }

        if ($this->criteria) {
            $expression = $this->criteria->dump();

            if ($expression) {
                $this->sql .= ' WHERE ' . $expression;
            }

            $this->mountPropertiesInstruction();
        }
        return $this->sql .= ";";
    }

    private function mountPropertiesInstruction()
    {
        $order = $this->criteria->getProperty('order');
        $orderDirection = $this->criteria->getProperty('orderDirection');
        $limit = $this->criteria->getProperty('limit');
        $offset = $this->criteria->getProperty('offset');

        if ($order) {
            $this->sql .= ' ORDER BY ' . $order;
            if ($orderDirection == 'DESC') {
                $this->sql .= ' DESC';
            } else {
                $this->sql .= ' ASC';
            }
        }
        if ($limit) {
            $this->sql .= ' LIMIT ' . $limit;
        }
        if ($offset) {
            $this->sql .= ' OFFSET ' . $offset;
        }
    }

    public function getInstruction()
    {
        $this->mountInstruction();
        return $this->sql;
    }
}
