



<div id="carForm">
    <form action="/car" method="post">

        <label>
            Model:
            <input type="text" name="model">
        </label>
        <label>
            Speed:
            <input type="text" name="speed">
        </label>
        <label>
            Price:
            <input type="text" name="price">
        </label>
        <input type="submit" value="Submit">
    </form>
</div>

<div id="ErrorMsg">
    <p style="color: red">
        <?= \Web\Page::printError("pdoErr") ?>
    </p>
</div>