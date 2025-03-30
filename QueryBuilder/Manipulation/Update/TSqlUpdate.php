<?php

namespace QueryBuilder\Manipulation\Update;

use QueryBuilder\Manipulation\TSqlInstruction;
use Error;
use Exception;

/**
 * Esta classe prove meios para manipulacao de uma instrucao de UPDATE no banco de dados
 */
final class TSqlUpdate extends TSqlInstruction
{
    private $columnValues;

    /**
     * Atribui valores a determinadas colunas no banco de dados que serao modificadas
     * @param $column = coluna da tabela
     * @param $value = valor que sera inserido
     */
    public function setRowData($column, $value)
    {
        if (is_scalar($value)) {
            if (is_string($value) and (!empty($value))) {
                $value = addslashes($value);

                $this->columnValues[$column] = "'$value'";
            } else if (is_bool($value)) {
                $this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
            } else if ($value !== '') {
                $this->columnValues[$column] = $value;
            } else {
                $this->columnValues[$column] = 'NULL';
            }
        }
    }

    /**
     * Verifica se as colunas contendo os valores estao criadas
     * Monta os set do UPDATE
     * `
     *  nome = 'Jefferson'
     *  idade = 'Richarlisson'
     * `
     * @return array;
     */
    private function mountColumnValues()
    {
        if ($this->columnValues) {
            foreach ($this->columnValues as $column => $value) {
                $set[] = "{$column} = $value";
            }
            return $set;
        }
    }

    private function mountInstruction(array $set)
    {
        try {
            if (empty($set)) {
                throw new Exception("Você não está informando nenhuma coluna para update");
            }
            $this->sql = "UPDATE {$this->table} ";
            
            $this->sql .= "SET " . implode(', ', $set);

            if ($this->criteria) {
                $this->sql .= ' WHERE ' . $this->criteria->dump() . ";";
            }

        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage() . "\n");       
        }
    }

    /**
     * Retorna a instrucao de update em forma de string
     */
    public function getInstruction()
    {
        $set = (array) $this->mountColumnValues();
        $this->mountInstruction($set);
        return $this->sql .= ";";
    }
}
