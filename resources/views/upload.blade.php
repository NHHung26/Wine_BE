<!DOCTYPE html>
<html>
<head>
    <title>Upload Multiple Files</title>
</head>
<body>
    <form action="/add-product" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file1">File 1:</label>
        <input type="text" name="name_product">

        <label for="file2">File 2:</label>
        <input type="text" name="the_tich">

        <label for="file3">File 3:</label>
        <input type="text" name="gia">

        <label for="file4">File 4:</label>
        <input type="text" name="so_luong">

        <label for="file5">File 5:</label>
        <input type="text" name="nong_do">

        <label for="file6">File 6:</label>
        <input type="text" name=" nsx">

        <label for="file7">File 7:</label>
        <input type="text" name="mo_ta">

        <label for="file8">File 8:</label>
   
        <input type="file" name="file">

        <button type="submit">Tải lên</button>
    </form>
</body>
</html>
