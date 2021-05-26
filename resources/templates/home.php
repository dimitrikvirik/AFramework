<?php

use Web\Page;
Page::addCss("home");
?>
<div id="inner">
   <div>
       <h2>CODING IS THE NEW COOL!</h2>
       <h1>SUMMER CAMPS</h1>
       <p>Immersive classes for age 4+ |
           Starts from 3 Kune</p>
           <button>JOIN US!</button>
   </div>

    <img src="<?= Page::asset('img/student-computer.png') ?>" alt="student computer">
</div>

