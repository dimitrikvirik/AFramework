<?php
$groups = \Web\Page::$var["groups"];
foreach ($groups as $group) {
    $user = \DB\DB::Table("users")->select()->byId($group["user_id"])->execute()->fetch();
    Util::exportData($user);
    Util::printUserInfo($user);
}