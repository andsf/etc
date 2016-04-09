<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
    <body>
    <form action="?update" method="post" ?>
    <table>
        <tr>
            <th>タイトル</th>
            <th>コメント</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="title" value=<?= $ret['title']; ?>>
            </th>
            <th>
                <textarea name="comment" rows="6" cols="30"><?= $ret['comment']; ?></textarea>
            </th>
        </tr>
    </table>
    <input type="hidden" name='comment_id' value = <?= $ret['comment_id']; ?>>
    <input type="submit" value="編集">
    </form>
    </body>
</html>
