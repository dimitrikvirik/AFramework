<?php


class Util
{

    /**
     * @param $func
     * @param string $attribute
     * @throws ReflectionException
     * გადაუვლის ყველა კლასს src დირექტორიაში და გამოიძახებს მაგაზე ფუნქციას
     */
    static function EachClass($func, string $attribute = "ANY"){

    }
    static function ReadConf($key){
        $json =  json_decode(file_get_contents("resources/config.json"), true);
        return $json[$key];
    }
    static function PrintError($key){
        if(isset( $_SESSION[$key."Err"])) {
            echo $_SESSION[$key . "Err"];
            unset($_SESSION[$key . "Err"]);
        }
    }
    static function PrintSuc($key){
        if(isset( $_SESSION[$key."Suc"])) {
            echo $_SESSION[$key . "Suc"];
            unset($_SESSION[$key . "Suc"]);
        }
    }
    static function goBack(){
        echo "<script>document.location.replace('".$_SERVER['HTTP_REFERER']."')</script>";
    }
    static  function  printUserInfo($user, $additional = ""){
                  echo  "<table class='table-info'>
                <tr>
                    <th colspan='2'>User Info</th>
                </tr>
                <tr>
                    <td>Firstname</td>
                    <td>{$user['firstname']}</td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td> {$user['lastname']}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{$user["email"]}</td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>{$user["phone"]}</td>
            </tr>
            <tr>
                <td>Age</td>
                <td>{$user["age"]}</td>
            </tr>".$additional."
            </table>";
      }
      static  function printUserPrograms($groups){
            echo "<table class='table-info'>  
            <tr>
                <th colspan=`4`>Programs</th>
            </tr>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Teacher</th>
                <th></th>
            </tr>";
            foreach ($groups as &$group){
                $program = \DB\DB::Table("programs")->select()->byId($group["program_id"])->execute()->fetch();
                $program["teacher"] =  \DB\DB::Table("users")->select()->byId($program["teacher_id"])->execute()->fetch();
                $program_del = "/programs/rem/".$program["id"];
                echo "
                    <tr>
                        <td>{$program["title"]}</td>
                        <td>{$program["description"]}</td>
                        <td>{$program["teacher"]["firstname"]} {$program["teacher"]["lastname"]}</td>
                          <td><button onclick='location.href= `{$program_del}`'>Exit</button></td>
                    </tr>
                  ";
            }
            echo "</table>";
      }
       static function exportData(array $exportData, array $ignore, string $filename, bool $is_associated = true)
      {
          $array = [];
          foreach ($exportData as $key => $value) {
              if((!is_numeric($key) || !$is_associated)  && !in_array($value, $ignore))
                array_push($array, [$key, $value]);
          }
          header("Content-Disposition: attachment; filename=\"$filename\"");
          header("Expires: 0");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
          header("Cache-Control: private",false);
          $out = fopen("php://output", 'w');
          foreach ($array as $data) {
              fputcsv($out,  $data, "\t");
          }
          fclose($out);
      }

}