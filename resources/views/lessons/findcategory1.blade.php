<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>

<body>

    <!-- var_dump($category_list); -->

    <!-- lesson コントロールの serch メソッドの検索結果を表示 -->
    @foreach($category_list as $key => $v)
    <a href="/lessons/findcategory/{{ $key }}">{{ $v }}</a>
    @endforeach



</body>

</html>