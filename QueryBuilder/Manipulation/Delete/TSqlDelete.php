<?php

namespace QueryBuilder\Manipulation\Delete;

use QueryBuilder\Manipulation\TSqlInstruction;

/**
 * Essa classe prove meios para deletar manipulacao de uma instrucao DELETE
 */
final class TSqlDelete extends TSqlInstruction
{

    private function mountInstruction()
    {
        $this->sql = "DELETE FROM {$this->table}";

        if($this->criteria){
            $expression = $this->criteria->dump();

            if($expression){
                $this->sql .= " WHERE " . $expression;
            }
        }
    }

    public function getInstruction()
    {
        $this->mountInstruction();
        return $this->sql .= ";";
    }
}