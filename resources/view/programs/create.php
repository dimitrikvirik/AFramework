<form action="/programs/create" method="post" enctype="multipart/form-data">
    <p style="color: red"><?php Util::PrintError("val"); ?></p>
    <label>
        Title:
        <input type="text" name="title" required>
    </label>
    <label>
        Description:<br>
        <textarea  name="description" required rows="20" cols="70" style="resize: none"></textarea>
    </label>
    <input type="submit" value="Create" >
</form>