<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('your path here');
include 'Spherus/Autoloader.php';
//****************************************************


//use Spherus\Components\Query\Component;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;

$column1 = SqlFactory::Column('table1_id');
$column2 = SqlFactory::Column('table1_name');

$table1 = SqlFactory::Table('test1');
$table1->AddColumn($column1);
$table1->AddColumn($column2);

$column3 = SqlFactory::Column('table2_id');
$column4 = SqlFactory::Column('table2_name');

$table2 = SqlFactory::Table('test2');
$table2->AddColumn($column3);
$table2->AddColumn($column4);

$tt = $table1->LeftJoin($table2, $column1, $column3);

$select = SqlFactory::Select(SqlFactory::Max($column3))
    ->Distinct()
    ->From($table2)
    ->Where(SqlFactory::GreatherThan($column3, 22))
    ->GroupBy($column3, $column4)
    ->Having(SqlFactory::Equal($column4, 'ssssss'))
    ->OrderBy(array(
        SqlFactory::Order($column3, SqlOrderType::Ascending),
        SqlFactory::Order($column4, SqlOrderType::Descending)))
    ->Take(10)
    ->Skip(20);
