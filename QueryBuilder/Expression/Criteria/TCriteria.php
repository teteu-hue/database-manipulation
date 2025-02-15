<?php

namespace QueryBuilder\Expression\Criteria;

use QueryBuilder\Expression\Criteria\TPropertie\TPropertie;
use QueryBuilder\Expression\TExpression;

class TCriteria extends TExpression
{
    private $expressions;
    private $operators;

    public function __construct(
        private TPropertie $property = new TPropertie()
    )
    {
        $this->expressions = array();
        $this->operators = array();
    }


    /**
     * Adiciona uma expressao ao criterio de selecao
     */
    public function add(TExpression $expression, $operator = self::AND_OPERATOR)
    {
        if(empty($this->expressions)){
            $operator = null;
        }

        $this->expressions[] = $expression;
        $this->operators[] = $operator;
    }

    /**
     * Retorna a expressao final
     */
    public function dump()
    {
        if(is_array($this->expressions))
        {
            if(count($this->expressions) > 0)
            {
                $result = '';
                foreach($this->expressions as $count => $expression){
                    $operator = $this->operators[$count];

                    $result .= $operator . $expression->dump() . " ";
                    
                }
                $result = trim($result);
                return "({$result})";
            }
        }
    }

    /**
     * Define o valor de uma propriedade
     */
    public function setProperty($property, $value)
    {
        $this->property->setProperty($property, $value);
    }

    public function getProperty($property)
    {
        return $this->property->getProperty($property);
    }
}