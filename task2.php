<?php
function sumSecondaryDiagonal($matrix) {
    $n = count($matrix);
    $sum = 0;
    
    for ($i = 0; $i < $n; $i++) {
        $sum += $matrix[$i][$n - 1 - $i];
    }
    
    return $sum;
}

echo "Задача 2:\n";
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
echo "Матрица:\n";
foreach ($matrix as $row) {
    echo "[" . implode(", ", $row) . "]\n";
}
$result = sumSecondaryDiagonal($matrix);
echo "Сумма элементов побочной диагонали: $result\n";
echo "(Ожидаемый результат: 15)\n\n";
?>