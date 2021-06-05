<?php
$groups = \Web\Page::$var["groups"];
foreach ($groups as $group) {
    echo "<div>";
    $user = \DB\DB::Table("users")->select()->byId($group["user_id"])->execute()->fetch();
    $add = "<td><button onclick='location.href = `/user/export/{$user['id']}` '>Export</button></td>";
    Util::printUserInfo($user, $add);
}