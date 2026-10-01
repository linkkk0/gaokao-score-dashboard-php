<?php require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/../config/database.php';
$o = ['exams' => []];
foreach (db()->query('SELECT exam_date,exam_name,chinese,math,english,physics,chemistry,biology,total FROM exams ORDER BY exam_date,id') as $r) $o['exams'][] = ['date' => $r['exam_date'], 'exam' => $r['exam_name'], 'scores' => ['chinese' => (float)$r['chinese'], 'math' => (float)$r['math'], 'english' => (float)$r['english'], 'physics' => (float)$r['physics'], 'chemistry' => (float)$r['chemistry'], 'biology' => (float)$r['biology']], 'total' => (float)$r['total']];
header('Content-Type:application/json;charset=utf-8');
header('Content-Disposition:attachment;filename="scores.json"');
echo json_encode($o, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
