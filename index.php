<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('_');
include 'Spherus/Autoloader.php';
//****************************************************


//use Spherus\Components\Query\Component;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlQuery;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\MySQL\MySQLCompiler;

$column1 = SqlFactory::Column('table1_id');
$column2 = SqlFactory::Column('table1_name');

$table1 = SqlFactory::Table('test1');
$table1->AddColumn($column1);
$table1->AddColumn($column2);

$column3 = SqlFactory::Column('table2_id', null, 'some_alias');
$column4 = SqlFactory::Column('table2_name');

$table2 = SqlFactory::Table('test2');
$table2->AddColumn($column3);
$table2->AddColumn($column4);

$tt = $table1->LeftJoin($table2, $column1, $column3);
$select0 = SqlFactory::Select($table2, array ($column3, $column4));

$case = SqlFactory::Case_($column3);
$case->Condition('39', 5);
$case->Condition(SqlFactory::GreatherThan($column3, 20), $column4);
$case->Else_(32);

$select = SqlFactory::Select($table2, array ($column3, $column4))
    ->Distinct()
    ->From($tt)
    ->AddColumn($case)
    ->Where(SqlFactory::And_(SqlFactory::In($column1, $select0), SqlFactory::LessThan($column3, 2222)))
    ->GroupBy($column3, $column4)
    ->Having(SqlFactory::Equal($column4, 'ssssss'))
    ->OrderBy(array(
        SqlFactory::Order($column3, SqlOrderType::Ascending),
        SqlFactory::Order($column4, SqlOrderType::Descending)))
    ->Take(10)
    ->Skip(20);
    
$sqlQuery = new SqlQuery(new MySQLCompiler());

//echo('<pre>');
var_dump($sqlQuery->GenerateSql($select));
//echo('</pre>');