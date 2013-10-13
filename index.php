<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('_path here_');
include 'Spherus/Autoloader.php';
//****************************************************


//use Spherus\Components\Query\Component;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlQuery;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Compiler\MySQL\MySQLCompiler;
use Spherus\Components\Query\Component\SqlDatabaseQuery\Enums\SqlOrderType;

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

$case1 = SqlFactory::Case_($column3);
$case1->Condition('xxx', 5);
$case1->Condition(SqlFactory::Equal($column3, 99999), $column4);
$case1->Else_(32);

$case = SqlFactory::Case_($column3);
$case->Condition(SqlFactory::Exists(2), 'something exist');
$case->Condition(SqlFactory::GreatherThan($column3, 20), $column4);
$case->Condition($case1, 'newCase');
$case->Else_(32);

$select = SqlFactory::Select($table2, array ($column3, $column4))
    ->Distinct()
    ->From($tt)
    ->AddColumn(SqlFactory::RowNumber($column4))
    ->AddColumn(SqlFactory::Multiply(2, 3), 'some_alias')
    ->AddColumn($case)
    ->Where(SqlFactory::And_(SqlFactory::In($column1, $select0), SqlFactory::LessThan($column3, 2222)))
    ->GroupBy($column3, $column4)
    ->Having(SqlFactory::Equal($column4, 'some_having'))
    ->OrderBy(SqlFactory::Order($column3, SqlOrderType::Ascending))
    ->Take(10)
    ->Skip(20);
    
 $sqlQuery = new SqlQuery(new MySQLCompiler());
var_dump($sqlQuery->GenerateSql($select));


$select20 = SqlFactory::Select();
$select21 = SqlFactory::Select($table2);
$ttt = SqlFactory::Intersect($select, $select21);
var_dump($sqlQuery->GenerateSql($ttt)->getSql());

$delete = SqlFactory::Delete($table1)->Where(SqlFactory::In($column2, '33,44,55'));

$if = SqlFactory::If_(SqlFactory::Exists($select0), 'YES', 'NO');

$insert = SqlFactory::Insert($table1)->Add($column1, $select);

$update = SqlFactory::Update($table1)->Set($column1, 22)->Where(SqlFactory::Equal($column1, 2234));
 
var_dump($sqlQuery->GenerateSql($update)->getSql());