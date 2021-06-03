<?php
use Web\Page;
$programs = Page::$var["programs"];
Page::addCss("program");
?>
<table class='table-info'>
    <div id="program-status">
        <p style="color: red"><?php Util::PrintError("val"); ?> </p>
        <p style="color: green"><?php Util::PrintSuc("val"); ?> </p>
    </div>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Teacher</th>
        <th></th>
    </tr> 
<?php
foreach ($programs as &$program){
    $program_reg = "/programs/add/".$program["id"];
  echo "
    <tr>
        <td>{$program["title"]}</td>
        <td>{$program["description"]}</td>
        <td>{$program["teacher"]["firstname"]} {$program["teacher"]["lastname"]}</td>
        <td><button onclick='location.href= `{$program_reg}`'>Join</button></td>
    </tr>
 
    ";
}
?>
</table>