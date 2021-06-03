<?php \Web\Page::addCss("user") ?>
<div id="inner">
<form  action="/user/login" method="post">
    <p style="color: red"><?php  Util::PrintError("val"); ?></p>
    <label>
        Email:
        <input type="email" name="email">
    </label>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <input type="submit" value="Login">
    <a href="/user/reg">Registration</a>
    <a href="/user/recover">Forget Password?</a>
</form>

</div>