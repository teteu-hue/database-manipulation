<?php

namespace QueryBuilder\Expression;

/**
 * Classe que gerencia as as expressoes SQL
 */
abstract class TExpression
{
   const AND_OPERATOR = 'AND ';
   const OR_OPERADOR = 'OR ';

   abstract public function dump();
}