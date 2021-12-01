<?php
/**
 * @param $a
 * @param $b
 * @return int
 */
function sum($a, $b) {
    return $a + $b;
}
$sumReflector = new ReflectionFunction('sum');
echo $sumReflector->getFileName();
echo $sumReflector->getEndLine();
echo $sumReflector->getStartLine();
echo $sumReflector->getDocComment();