<header>
    <button id="menu-button"></button>
    <h1 id="title"><a href="/">ACADEMY</a></h1>
    <ul id="menu">

        <?php if(!isset($_SESSION["user"])): ?>
        <li><a href="/">Home</a></li>
        <li><a href="/user/login">Login</a></li>
        <?php else: ?>
        <li><a href="/">Profile</a></li>
        <li><a href="/programs">Programs</a></li>
        <?php endif; ?>
        <li><a href="/about-us">About Us</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>
</header>
