<?php


namespace Academy\Program;


use Objects\NotFoundObject;

interface  ProgramServe
{
     function get(): array;
     function getById(int $id): ProgramView| NotFoundObject;
     function add(ProgramView $programView): void;
     function edit(int $id, ProgramView $programView): void;
     function delete(int $id): void;
}