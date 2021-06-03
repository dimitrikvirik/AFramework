<?php


 abstract class Migration
{
    private string $tableName;

   abstract function up();
   abstract function down();

   
}