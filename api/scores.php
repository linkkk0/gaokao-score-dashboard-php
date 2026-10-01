<?php

declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json; charset=utf-8');
try {
    $s = db()->query('SELECT exam_date,exam_name,chinese,math,english,physics,chemistry,biology,total FROM exams ORDER BY exam_date,id');
    $a = [];
    foreach ($s as $r) $a[] = ['date' => $r['exam_date'], 'exam' => $r['exam_name'], 'scores' => ['chinese' => (float)$r['chinese'], 'math' => (float)$r['math'], 'english' => (float)$r['english'], 'physics' => (float)$r['physics'], 'chemistry' => (float)$r['chemistry'], 'biology' => (float)$r['biology']], 'total' => (float)$r['total']];
    echo json_encode(['exams' => $a], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => '数据库读取失败'], JSON_UNESCAPED_UNICODE);
}
