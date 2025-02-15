<?php

namespace QueryBuilder\Expression\Filter;

use QueryBuilder\Expression\TExpression;
/**
 * Esta classe prove uma interface para definicao de filtros de selecao
 */
class TFilter extends TExpression
{
    private $variable;
    private $operator;
    private $value;

    public function __construct($variable, $operator, $value)
    {
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value);
    }

    public function transform($receiptValue)
    {
        if (is_array($receiptValue)) {
            foreach ($receiptValue as $transformedValue) {
                if (is_integer($transformedValue)) {
                    $values[] = $transformedValue;
                } else if (is_string($transformedValue)) {
                    $values[] = "'$transformedValue'";
                }
            }
            $result = '(' . implode(', ', $values) . ')';
        } 
        else if (is_string($receiptValue)) 
        {
            $result = "'$receiptValue'";
        }
        else if (is_null($receiptValue))
        {
            $result = 'NULL';
        }
        else if(is_bool($receiptValue))
        {
            $result = $receiptValue ? 'TRUE' : 'FALSE';
        }
        else 
        {
            $result = $receiptValue;
        }
        return $result;
    }


    public function dump()
    {
        return "{$this->variable} {$this->operator} {$this->value}";
    }
}
