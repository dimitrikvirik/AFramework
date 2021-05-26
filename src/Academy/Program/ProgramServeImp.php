<?php


namespace Academy\Program;


use Annotation\Component;
use Annotation\Mapping\PostMapping;
use DB\DB;
use Objects\NotFoundObject;
use R;
use Util;

#[Component]
class ProgramServeImp implements ProgramServe
{

    function get(): array
    {
       return R::findAll("programs");
    }

    function getById(int $id): ProgramView|NotFoundObject
    {
        $arr =   R::findOne( 'programs', ' id = ? ', [ $id]);
      return Util::toObject((array)$arr, ProgramView::class);
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