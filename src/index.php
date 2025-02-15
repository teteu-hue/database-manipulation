<?php

use QueryBuilder\Expression\Criteria\TCriteria;
use QueryBuilder\Expression\Filter\TFilter;
use QueryBuilder\Expression\TExpression;
use QueryBuilder\Manipulation\Select\TSqlSelect;

require_once __DIR__ . '/../vendor/autoload.php';

$criteria1 = new TCriteria();
$criteria1->add(new TFilter("sexo", "=", 'f'));
$criteria1->add(new TFilter("serie", "=", 8));

$criteria2 = new TCriteria();
$criteria2->add(new TFilter(variable: "sexo", operator: "=", value: 'm'));
$criteria2->add(new TFilter(variable: "serie", operator: ">", value: 15));

$criteria = new TCriteria();
$criteria->add($criteria1);
$criteria->add($criteria2, TExpression::OR_OPERADOR);
$criteria->setProperty("order", "serie");
$criteria->setProperty("orderDirection", "ASC");

$select_querie = new TSqlSelect();
$select_querie->setTable('teste');
$select_querie->addColumn('nome');
$params = [
    "tables" => [
        "clientes",
        "pedidos"
    ],
    "operator" => "=",
    "columns" => [
        "id",
        "cliente_id"
    ]
];
$select_querie->join("INNER", $params);

$select_querie->setCriteria($criteria);

echo $select_querie->getInstruction() . "\n";
