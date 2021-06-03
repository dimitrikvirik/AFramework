<?php


namespace User;


interface UserService
{
    function create(array $data);
    function logout();
    function read();
    function delete(int $id);
    function edit(int $id,  $userView);
    function login(array $data);
    function recover();
}