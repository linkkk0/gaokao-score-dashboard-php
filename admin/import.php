<?php $title = '导入 JSON';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $d = json_decode(file_get_contents($_FILES['json']['tmp_name']), true);
    $items = $d['exams'] ?? $d;
    if (!is_array($items)) $msg = 'JSON 格式无效';
    else {
        try {
            $p = db();
            $p->beginTransaction();
            if (($_POST['mode'] ?? 'append') === 'replace') $p->exec('DELETE FROM exams');
            $s = $p->prepare('INSERT INTO exams(exam_date,exam_name,chinese,math,english,physics,chemistry,biology,total) VALUES(?,?,?,?,?,?,?,?,?)');
            foreach ($items as $x) {
                $z = $x['scores'] ?? [];
                $v = [(float)($z['chinese'] ?? 0), (float)($z['math'] ?? 0), (float)($z['english'] ?? 0), (float)($z['physics'] ?? 0), (float)($z['chemistry'] ?? 0), (float)($z['biology'] ?? 0)];
                $s->execute([$x['date'], $x['exam'], ...$v, (float)($x['total'] ?? array_sum($v))]);
            }
            $p->commit();
            $msg = '导入成功，共 ' . count($items) . ' 条。';
        } catch (Throwable $e) {
            $p->rollBack();
            $msg = '导入失败，请检查数据。';
        }
    }
} ?><div class="card">
    <h1>导入 JSON</h1><?php if ($msg): ?><div class="notice"><?= h($msg) ?></div><?php endif; ?><form method="post" enctype="multipart/form-data"><input type="hidden" name="csrf" value="<?= h(csrf()) ?>">
        <div class="field"><label>JSON 文件</label><input type="file" name="json" accept=".json" required></div><br><select name="mode">
            <option value="append">追加</option>
            <option value="replace">替换全部</option>
        </select><br><br><button class="btn primary">导入</button>
    </form>
</div><?php require __DIR__ . '/includes/footer.php';
