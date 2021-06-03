<?php


namespace Program;


use Objects\NotFoundObject;

interface  ProgramServe
{
     function get(): array;
     function getById(int $id);
     function addToUser(int $id): void;
     function delToUser(int $id);

     function create($data);
     function edit(int $id, ProgramView $programView): void;
     function delete(int $id): void;
}