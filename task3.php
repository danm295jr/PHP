<?php
function isZigzag($arr) {
    $n = count($arr);
    
    if ($n < 3) {
        return false;
    }
    $pattern1 = true;
    for ($i = 0; $i < $n - 1; $i++) {
        if ($i % 2 == 0) {
            if ($arr[$i] >= $arr[$i + 1]) {
                $pattern1 = false;
                break;
            }
        } else {
            if ($arr[$i] <= $arr[$i + 1]) {
                $pattern1 = false;
                break;
            }
        }
    }
    $pattern2 = true;
    for ($i = 0; $i < $n - 1; $i++) {
        if ($i % 2 == 0) {
            if ($arr[$i] <= $arr[$i + 1]) {
                $pattern2 = false;
                break;
            }
        } else {
            if ($arr[$i] >= $arr[$i + 1]) {
                $pattern2 = false;
                break;
            }
        }
    }
    
    return $pattern1 || $pattern2;
}
$testCases = [
    [1, 3, 2, 4, 3, 5],
    [5, 3, 6, 2, 7, 1],
    [1, 2, 3, 4, 5],
    [5, 4, 3, 2, 1],
    [1, 3, 2, 4, 3],
    [3, 1, 4, 2, 5],
    [1, 1, 2, 1, 2],
    [10, 5, 8, 3, 6]
];

foreach ($testCases as $test) {
    $result = isZigzag($test) ? "ДА" : "НЕТ";
    echo "Массив [" . implode(", ", $test) . "] -> " . $result . "\n";
}
$example1 = [1, 3, 2, 4, 3, 5];
$example2 = [10, 5, 8, 3, 6];

echo "Пример 1 (паттерн < > < > <):\n";
echo "[" . implode(", ", $example1) . "]\n";
for ($i = 0; $i < count($example1) - 1; $i++) {
    $relation = ($i % 2 == 0) ? "<" : ">";
    $check = ($i % 2 == 0) ? 
        ($example1[$i] < $example1[$i + 1]) : 
        ($example1[$i] > $example1[$i + 1]);
    $status = $check ? "✓" : "✗";
    echo "  " . $example1[$i] . " " . $relation . " " . $example1[$i + 1] . " " . $status . "\n";
}
echo "Результат: " . (isZigzag($example1) ? "зигзаг" : "не зигзаг") . "\n\n";

echo "Пример 2 (паттерн > < > <):\n";
echo "[" . implode(", ", $example2) . "]\n";
for ($i = 0; $i < count($example2) - 1; $i++) {
    $relation = ($i % 2 == 0) ? ">" : "<";
    $check = ($i % 2 == 0) ? 
        ($example2[$i] > $example2[$i + 1]) : 
        ($example2[$i] < $example2[$i + 1]);
    $status = $check ? "✓" : "✗";
    echo "  " . $example2[$i] . " " . $relation . " " . $example2[$i + 1] . " " . $status . "\n";
}
echo "Результат: " . (isZigzag($example2) ? "зигзаг" : "не зигзаг") . "\n\n";