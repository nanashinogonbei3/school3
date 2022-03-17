<body>
    <form action="/image/store" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/png, image/jpeg">
        <input type="submit" value="投稿">
    </form>
</body>
