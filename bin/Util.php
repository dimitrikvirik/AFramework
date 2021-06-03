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
        $di = new RecursiveDirectoryIterator('src/');
        //გადავუვლით ყველა ფაილებს ყველა ქვეპაპკაში
        if($attribute != "ANY") $attribute = "Annotation\\".$attribute;
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if (str_ends_with($file, ".php")) {
                $className = substr($file, 3, -4);
                $refClass = new ReflectionClass($className);
                foreach ($refClass->getAttributes() as &$atr){
                    if( $atr->getName() ==  $attribute || $attribute == "ANY"){
                        call_user_func($func, $refClass);
                    }
                }
            }
        }
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
    static  function  printUserInfo($user){
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
            </tr>
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
                $program_del = "/programs/del/".$program["id"];
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
      public static function exportData($data){
          $fp = fopen('file.csv', 'w');

          fputcsv($fp,$data,"\t");
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header("Cache-Control: no-cache, must-revalidate");
          header("Expires: 0");
          header('Content-Disposition: attachment; filename="'.basename("file.csv").'"');
          header('Content-Length: ' . filesize("file.csv"));
          header('Pragma: public');

//Clear system output buffer
          flush();

//Read the size of the file
          readfile("file.csv");

          fclose($fp);
      }


}