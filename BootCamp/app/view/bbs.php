<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
    <body>
    <h1>簡易掲示板</h1>
<?php if(empty($ret)): ?>
    <p>データなし</p>
<?php else: ?>
    <table>
        <tr>
            <th>タイトル</th>
            <th>編集</th>
            <th>論理削除</th>
            <th>物理削除</th>
        </tr>
        <?php foreach($ret as $key): ?>
        <tr>
            <th> <?= $key['title']; ?> </th>
            <th> <a href=<?= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/update/'.$key['comment_id'] ?> >編集</a> </th>
            <th> <a href="javascript:void(0)" onclick="funcLogicDelete(<?= $key['comment_id'] ?>)" >削除</a> </th>
            <th> <a href="javascript:void(0)" onclick="funcDelete(<?= $key['comment_id'] ?>)" >削除</a> </th>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
    <div>
        <a href=<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/insert'?> >追加</a>
    </div>
    </body>
</html>
<script type="text/javascript">
function funcLogicDelete(param){
    ret = confirm("本当にいいですか？");
    if(ret == true){
        location.href = location.pathname+'/logicDelete/'+param;
    }
}
function funcDelete(param){
    ret = confirm("本当にいいですか？");
    if(ret == true){
        location.href = location.pathname+'/delete/'+param;
    }
}
</script>
