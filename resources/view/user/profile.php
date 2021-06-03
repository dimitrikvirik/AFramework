<?php $user = $_SESSION["user"];
\Web\Page::addCss("user");
Util::printUserInfo($user);
$groups = \DB\DB::Table("groups")->select()->where("user_id = {$user["id"]}")->execute()->fetchAll();
Util::printUserPrograms($groups);
?>
<form action="/user/logout" method="post">
    <input type="submit" value="Logout">
</form>
