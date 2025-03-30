<?php

use Connection\TConnection;
use Connection\Transaction;
use QueryBuilder\Expression\Criteria\TCriteria;
use QueryBuilder\Expression\Filter\TFilter;
use QueryBuilder\Expression\TExpression;
use QueryBuilder\Manipulation\Insert\TSqlInsert;
use QueryBuilder\Manipulation\Select\TSqlSelect;
use QueryBuilder\Manipulation\Update\TSqlUpdate;

require_once __DIR__ . '/../vendor/autoload.php';

// $criteria1 = new TCriteria();
// $criteria1->add(new TFilter("sexo", "=", 'f'));
// $criteria1->add(new TFilter("serie", "=", 8));

// $criteria2 = new TCriteria();
// $criteria2->add(new TFilter(variable: "sexo", operator: "=", value: 'm'));
// $criteria2->add(new TFilter(variable: "serie", operator: ">", value: 15));

// $criteria = new TCriteria();
// $criteria->add($criteria1);
// $criteria->add($criteria2, TExpression::OR_OPERADOR);
// $criteria->setProperty("order", "serie");
// $criteria->setProperty("orderDirection", "ASC");
try {
    Transaction::open('mysql');

    $insert = new TSqlInsert();
    $insert->setTable('famosos');
    $insert->setRowData('codigo', 2);
    $insert->setRowData('nome', 'Jose Pinto lixo');

    $conn = Transaction::get();

    $result = $conn->query($insert->getInstruction());

    $update = new TSqlUpdate();
    $update->setTable('famosos');
    $update->setRowData('nome', 'Jose Aldo Santos');

    $criteria = new TCriteria();
    $criteria->add(new TFilter('codigo', '=', 2));

    $update->setCriteria($criteria);

    $conn = Transaction::get();
    $results = $conn->query($update->getInstruction());

    Transaction::commit();

} catch(Exception $e) {
    echo $e->getMessage() . "\n";

    Transaction::rollback();
    
}

$select_querie = new TSqlSelect();
$select_querie->setTable('teste');
$select_querie->addColumn('nome');
// $params = [
//     "tables" => [
//         "clientes",
//         "pedidos"
//     ],
//     "operator" => "=",
//     "columns" => [
//         "id",
//         "cliente_id"
//     ]
// ];
// $select_querie->join("INNER", $params);

// $select_querie->setCriteria($criteria);


