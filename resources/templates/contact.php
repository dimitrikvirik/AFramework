<?php \Web\Page::addCss("contact"); ?>
<div id="inner">
    <div>
        <ul id="contact-info">
            <li>Address <a href="https://cutt.ly/lntR5Tg" target="_blank">296 Z-1 Hemant Vihar Barra-2 Kanpur-208027</a></li>
            <li>Email <a href="mailto:info@orangeskill.com" >info@orangeskill.com</a></li>
            <li>Phone <a href="tel:+918318202800">+91 831-820-2800</a></li>
        </ul>
        <form action="/contact" method="post">
            <label>
                Firstname:
                <input type="text" name="firstname">
            </label>
            <label>
                LastName:
                <input type="text" name="lastname">
            </label>
            <label>
                Organization:
                <input type="text" name="organization">
            </label>
            <label>
                Phone:
                <input type="tel" name="phone">
            </label>
            <input type="submit">
        </form>
    </div>
    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d893.1840515506801!2d80.30293172923301!
    3d26.43198809986884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c47037d93e341%3A0x78cd1ee192db4525!
    2sUniversal%20Traders!5e0!3m2!1ska!2sge!4v1622027534960!5m2!1ska!2sge"  style="border:0;"
            allowfullscreen="" loading="lazy"></iframe>
</div>

