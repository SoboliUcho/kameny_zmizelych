<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    
<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script>
        tinymce.init({
            selector:'#novyObsah',
            language: 'cs',
            plugins:"  autolink accordion  lists advlist link media table image quickbars media",
            // plugins:"a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist link media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker",
            toolbar: "undo redo | bold italic casechange | blocks | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | link insertfile image table | removeformat",
            table_appearance_options: false,
            table_use_colgroups: false,
        });
    </script>
</head>

<body>
    <form action="_o_projektu.php" method="post">
        <textarea id="novyObsah" name="novyObsah" rows="10" cols="80"></textarea><br>
        <input type="submit" value="Aktualizovat Obsah">
    </form>

</body>

</html>

<?php
print_r($_POST)
    ?>