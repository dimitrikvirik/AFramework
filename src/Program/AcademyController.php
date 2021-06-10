<?php



namespace Program;
use Annotation\Controller;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;


use Web\Page;

#[Controller]
class AcademyController
{


    #[GetMapping]
    function home(){
        if(!isset($_SESSION["user"])) {
            Page::view("home", "Home page");
        }else{
            Page::view("user/profile", "User Profile");
        }
    }
    #[GetMapping("/about-us")]
    function aboutUs(){
        Page::view("about-us", "About Us");
    }
    #[GetMapping("/holiday-camps")]
    function holidayCamps(){
        Page::view("holiday-camps", "Holiday Camps");
    }
    #[GetMapping("/contact")]
    function contact(){
        Page::view("contact", "Contact");
    }
    #[PostMapping("/contact")]
    function contactPost(){
        //Validation
        $fn =  (!ctype_alpha($_POST["firstname"]))?"Firstname must contain only letters": null;
        $ln =  (!ctype_alpha($_POST["lastname"]))?"Lastname must contain only letters": null;
        $pn =  (!is_numeric($_POST["phone"]))? "Phone number must contain only numbers": null;
        if($fn || $ln || $pn){
            $_SESSION["valErr"] =  $fn."<br>".$ln."<br>".$pn;
        }
        else{
            try {
                DB::Table("contacts")->Insert($_POST)->execute();
            }catch (PDOException $e){
                $_SESSION["valErr"] = "Request Error: ".$e->getMessage();
            }
        }
    }
}