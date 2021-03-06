<?php

namespace  Program;


use Annotation\Controller;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\Variable\PathVariable;


use DB\DB;
use Web\Page;

#[Controller]
#[RequestMapping("/user")]
class UserController
{


    #[GetMapping("/login")]
    function login(){
        Page::view("user/login", "Login");
    }
    #[PostMapping("/login")]
    function loginForm(){
        $data = $_POST;
        $pdo =  DB::Table("users")->select()->where("email = '{$data['email']}'")->execute();
        $user = $pdo->fetch();
        $hash = $user["password"];
        if(password_verify($data['password'], $hash )){
            $_SESSION["user"] = $user;
            header("Location: /");
        }
        else{
            $_SESSION["valErr"] = "Wrong email or password!";
            header("Location: /user/login");
        }

    }
    #[GetMapping("/reg")]
    function reg(){
        Page::view("user/reg", "Registration");
    }
    #[PostMapping("/reg")]
    function regForm(){
        $data = $_POST;

        $target_dir = "resources/upload/";
        $newFilename=   date('dmYHis').$_FILES["profilePhoto"]["name"];
        $target_file = $target_dir.$newFilename;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageErr = "";
        if ($_FILES["profilePhoto"]["size"] > 1000000) {
            $imageErr = "File is too big";
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $imageErr = "File is not image";
        }
        if ($imageErr != "") {
            $_SESSION["valErr"] = "Wrong $imageErr! Try again";
            exit;
        }

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
                $data["profile_src"] = "/".$target_file;
                DB::Table("users")->insert($data)->execute();
                move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file);
            }catch (\PDOException $e){
                if(str_ends_with($e->getMessage(), "'email'"))
                    $_SESSION["valErr"] = "User with that email already registered";
                else $_SESSION["valErr"] = "Record error: ".$e->getMessage();
            }
        }
    }
    #[PostMapping("/logout")]
    function logout(){
        unset($_SESSION["user"]);
        \Util::goBack();
    }
    #[GetMapping("/export/{id}")]
    function export(#[PathVariable] int $id){
        if($_SESSION["user"]["is_admin"]) {
            $user = DB::Table("users")->select()->byId($id)->execute()->fetch();
            \Util::exportData($user, array($user["password"], $user["is_admin"]), $user["firstname"] . " " . $user["lastname"].".txt");
        }
    }



}