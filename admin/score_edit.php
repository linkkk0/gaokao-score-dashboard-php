<?php $title = '编辑成绩';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';
$id = (int)($_GET['id'] ?? 0);
$r = ['exam_date' => '', 'exam_name' => '', 'chinese' => 0, 'math' => 0, 'english' => 0, 'physics' => 0, 'chemistry' => 0, 'biology' => 0];
if ($id) {
    $s = db()->prepare('SELECT * FROM exams WHERE id=?');
    $s->execute([$id]);
    $r = $s->fetch() ?: $r;
} ?><div class="card">
    <h1><?= $id ? '编辑' : '添加' ?>成绩</h1>
    <form method="post" action="save.php"><input type="hidden" name="csrf" value="<?= h(csrf()) ?>"><input type="hidden" name="id" value="<?= $id ?>">
        <div class="grid">
            <div class="field"><label>日期</label><input type="date" name="exam_date" value="<?= h($r['exam_date']) ?>" required></div>
            <div class="field"><label>考试名称</label><input name="exam_name" value="<?= h($r['exam_name']) ?>" required></div><?php foreach (['chinese' => '语文', 'math' => '数学', 'english' => '英语', 'physics' => '物理', 'chemistry' => '化学', 'biology' => '生物'] as $k => $n): ?><div class="field"><label><?= $n ?></label><input type="number" step=".01" name="<?= $k ?>" value="<?= h($r[$k]) ?>" required></div><?php endforeach; ?>
        </div><br><button class="btn primary">保存</button> <a class="btn" href="index.php">取消</a>
    </form>
</div><?php require __DIR__ . '/includes/footer.php';
