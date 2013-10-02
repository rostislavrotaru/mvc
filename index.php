<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('D:\Programming\SPHERUS_PHP\SOURCECODE');
include 'Spherus/Autoloader.php';
//****************************************************


use Spherus\Components\Data\Component;
use Spherus\Components\Data\Component\Providers\MySqlDatabase;
use Spherus\Components\Data\Component\DatabaseConfig;

$component = new Component();
echo $component->getDescription();
echo('<pre>');
var_dump($component);
echo('</pre>');

$databaseConfig = new DatabaseConfig("host", "3306", "database", "root", "password");
$sqlDatabase = new MySqlDatabase($databaseConfig);

$sqlDatabase->BeginTransaction();
try 
{
    $sqlDatabase->ExecuteSqlNonQuery("insert into roles values(null, 'dddwed')");
    $sqlDatabase->ExecuteSqlNonQuery("update users set user_login = 'admin' where user_id = 1");
    $users = $sqlDatabase->ExecuteSqlNonQuery("update users set user_login = 'test' where user_id = 2");
    $sqlDatabase->CommitTransaction();
}
catch(\Exception $e)
{
    $sqlDatabase->RollbackTransaction();
}
$t = 2;