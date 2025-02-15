<?php

namespace QueryBuilder\Manipulation\Insert;

use QueryBuilder\Expression\Criteria\TCriteria;
use QueryBuilder\Manipulation\TSqlInstruction;
use Exception;

final class TSqlInsert extends TSqlInstruction
{
    private $columnValues;

    /**
     * metodo setRowData()
     * 
     * Atribui valores a determinadas colunas no banco de dados
     * @param $column = coluna da tabela
     * @param $value = valor a ser armazenado
     */
    public function setRowData($column, $value)
    {
        if(is_scalar($value)){
            if(is_string($value) AND (!empty($value))){
                // add \ em aspas
                $value = addslashes($value);
                // caso seja uma string
                $this->columnValues[$column] = "'$value'";
            }
            else if(is_bool($value)){
                $this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
            }
            else if($value !==''){
                $this->columnValues[$column] = $value;
            }
            else {
                $this->columnValues[$column] = "NULL";
            }
        }
    }

    /**
     * Nao existe no contexto dessa classe, caso seja executado lanca uma Exception
     */
    #[\Override]
    public function setCriteria(TCriteria $criteria)
    {
        throw new Exception("Cannot call setCriteria from " . __CLASS__);
    }

    private function mountInstruction()
    {
        $columns = implode(', ', array_keys($this->columnValues));
        $values = implode(', ', array_values($this->columnValues));
        $this->sql = "INSERT INTO {$this->table} (";
        $this->sql .= $columns . ") VALUES({$values});";
    }

    public function getInstruction()
    {
        $this->mountInstruction();
        return $this->sql;
    }
}