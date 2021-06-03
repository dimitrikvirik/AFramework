<?php
use Web\Page;
$programs = Page::$var["programs"];
Page::addCss("program");
$isAdmin = !$_SESSION["user"]["is_admin"];
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
        <?php if($isAdmin) echo "<th></th><th></th>" ?>
    </tr> 
<?php
foreach ($programs as &$program){
     $src = "/programs/";
     $src .= ($isAdmin)? "list/": "add/";
     $src .= $program["id"];

  echo "
    <tr>
        <td>{$program["title"]}</td>
        <td>{$program["description"]}</td>
        <td>{$program["teacher"]["firstname"]} {$program["teacher"]["lastname"]}</td>";
    if ($isAdmin){
        echo "
            <td><button onclick='deleteProgram({$program["id"]})'>Delete</button></td>
            <td><button onclick='editProgram({$program["id"]})'>Edit</button></td>
            <td><button onclick='location.href= `{$src}`'>Registred Students</button></td>
            ";

    }
    else{
        echo "
            <td><button onclick='location.href= `{$src}`'>Join</button></td>";
    }
    echo "</tr>";
}
?>
</table>
<?php if($isAdmin): ?>
<form action="/programs/create" method="get">
    <input type="submit" value="Create new Program">
</form>
<?php endif; ?>