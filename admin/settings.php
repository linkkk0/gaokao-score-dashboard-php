<?php $title = '修改密码';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $s = db()->prepare('SELECT password_hash FROM admins WHERE id=?');
    $s->execute([$_SESSION['admin_id']]);
    $a = $s->fetch();
    if ($a && password_verify($_POST['old'], $a['password_hash']) && strlen($_POST['new']) >= 8) {
        db()->prepare('UPDATE admins SET password_hash=? WHERE id=?')->execute([password_hash($_POST['new'], PASSWORD_DEFAULT), $_SESSION['admin_id']]);
        $msg = '密码修改成功。';
    } else $msg = '原密码错误或新密码少于 8 位。';
} ?><div class="card">
    <h1>修改密码</h1><?php if ($msg): ?><div class="notice"><?= h($msg) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= h(csrf()) ?>">
        <div class="field"><label>原密码</label><input type="password" name="old" required></div><br>
        <div class="field"><label>新密码（至少8位）</label><input type="password" name="new" minlength="8" required></div><br><button class="btn primary">保存</button>
    </form>
</div><?php require __DIR__ . '/includes/footer.php';
