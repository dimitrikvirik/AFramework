<?php


namespace Academy\Program;


use Annotation\Component;
use Annotation\Mapping\PostMapping;
use DB\DB;
use Objects\NotFoundObject;
use Util;

#[Component]
class ProgramServeImp implements ProgramServe
{

    function get(): array
    {
       return  DB::Table("programs")->Select();
    }

    function getById(int $id): ProgramView|NotFoundObject
    {
        $obj = DB::Table("programs")->SelectId($id, ProgramView::class);


      return  $obj;
    }

    function add(ProgramView $programView): void
    {
       DB::Table("programs")->Insert((array) $programView);

    }

    function edit(int $id, ProgramView $programView): void
    {
        // TODO: Implement edit() method.
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}