<?php $user = $_SESSION["user"];
\Web\Page::addCss("user") ?>
<table class="table-info">
    <tr>
        <th colspan="2">User Info</th>
    </tr>
    <tr>
        <td>Firstname</td>
        <td><?= $user["firstname"] ?></td>
    </tr>
    <tr>
        <td>Lastname</td>
        <td><?= $user["lastname"] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?= $user["email"] ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?= $user["phone"] ?></td>
    </tr>
    <tr>
        <td>Age</td>
        <td><?= $user["age"] ?></td>
    </tr>
 <?php
    $groups = \DB\DB::Table("groups")->select()->where("user_id = {$user["id"]}")->execute()->fetchAll();
 ?>
    <tr>
        <th colspan="2">Programs</th>
    </tr>

</table>
