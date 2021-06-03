<?php


namespace User;

use Annotation\Component;
use DB\DB;

#[Component]
class UserServiceImp implements UserService
{

    function create(array $data)
    {
        //შემოწმება
        $checks = [
            "email" =>  filter_var($data["email"], FILTER_VALIDATE_EMAIL),
            "firstname" => ctype_alpha($data["firstname"]),
            "lastname" => ctype_alpha($data["lastname"]),
            "age" => $data["age"] > 5 && $data["age"] < 100,
            "phone" => is_numeric($data["phone"]),
            "gender" =>  $data["gender"] == 'm' ||  $data["gender"] == 'f'
        ];
      $check_key =   array_search(false, $checks);
      if($check_key){
        $_SESSION["valErr"] = "Wrong $check_key! Try again";
      }
      else{
          try {
              $data["password"] = password_hash($data["password"],  PASSWORD_DEFAULT);
              DB::Table("users")->insert($data)->execute();
          }catch (\PDOException $e){
              if(str_ends_with($e->getMessage(), "'email'"))
                  $_SESSION["valErr"] = "User with that email already registered";
              else $_SESSION["valErr"] = "Record error: ".$e->getMessage();
          }
      }
     }

    function read()
    {
      return DB::Table("user")
          ->select()->byId($_SESSION["user"]["id"])
          ->execute()->fetch();
    }

    function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    function edit(int $id,  $userView)
    {
        // TODO: Implement edit() method.
    }

    function login(array $data): bool
    {
        $pdo =  DB::Table("users")->select()->where("email = '{$data['email']}'")->execute();
        $user = $pdo->fetch();
        $hash = $user["password"];
        if(password_verify($data['password'], $hash )){
             $_SESSION["user"] = $user;
        }
        else{
            $_SESSION["valErr"] = "Wrong email or password!";
            return false;
        }
        return  true;
    }

    function recover()
    {
        // TODO: Implement recovery() method.
    }
}