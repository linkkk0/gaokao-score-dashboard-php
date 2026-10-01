<?php $title = '成绩管理';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';
$q = trim($_GET['q'] ?? '');
$s = db()->prepare('SELECT * FROM exams WHERE exam_name LIKE ? ORDER BY exam_date DESC,id DESC');
$s->execute(['%' . $q . '%']);
$rows = $s->fetchAll(); ?><div class="card">
    <div class="top">
        <h1>成绩管理</h1>
        <div class="actions"><a class="btn primary" href="score_edit.php">添加成绩</a><a class="btn" href="export.php">导出 JSON</a><a class="btn" href="import.php">导入 JSON</a><a class="btn" href="settings.php">修改密码</a></div>
    </div>
    <form><input name="q" value="<?= h($q) ?>" placeholder="搜索考试名称"><button class="btn">搜索</button></form>
</div>
<div class="card">
    <table class="table">
        <tr>
            <th>日期</th>
            <th>考试</th>
            <th>总分</th>
            <th>操作</th>
        </tr><?php foreach ($rows as $r): ?><tr>
                <td><?= h($r['exam_date']) ?></td>
                <td><?= h($r['exam_name']) ?></td>
                <td><?= h($r['total']) ?></td>
                <td class="actions"><a class="btn" href="score_edit.php?id=<?= $r['id'] ?>">编辑</a>
                    <form method="post" action="delete.php" onsubmit="return confirm('确定删除？')"><input type="hidden" name="csrf" value="<?= h(csrf()) ?>"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn danger">删除</button></form>
                </td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require __DIR__ . '/includes/footer.php';
