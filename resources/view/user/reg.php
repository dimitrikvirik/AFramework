<?php \Web\Page::addCss("user") ?>
<div id="inner">
    <form  action="/user/reg" method="post" enctype="multipart/form-data">
        <p style="color: red"><?php Util::PrintError("val"); ?></p>
        <label>
            Profile photo:
            <input type="file" name="profilePhoto">
        </label>

        <label>
            Email:
            <input type="email" name="email" required>
        </label>
        <label>
            Password:
            <input type="password" name="password" required>
        </label>
        <label>
            Firstname:
            <input type="text" name="firstname" required>
        </label>
        <label>
            Lastname:
            <input type="text" name="lastname" required>
        </label>
        <label>
            Phone:
            <input type="tel" name="phone">
        </label>
        <label>
            Age:
            <input type="number" name="age">
        </label>
        <label>
            Gender:<br>
            <label for="gender-m">Male</label>
            <input type="radio" id="gender-m" name="gender" value="m">
            <label for="gender-f">Female</label>
            <input type="radio" id="gender-f" name="gender" value="f">
        </label>
        <input type="submit" value="Register">
        <a href="/user/login">Login</a>
    </form>

</div>