<?php

echo 'Building random data ...' . PHP_EOL;
//@ob_flush();
flush();
$data = '';
for ( $i = 0; $i < 64000; $i++ ) {
    $data .= hash('md5', rand(), true);
}
echo strlen($data) . ' bytes of random data built !' . PHP_EOL . PHP_EOL . 'Testing hash algorithms ...' . PHP_EOL;
//@ob_flush();
flush();
$results = array();
foreach ( hash_algos() as $v ) {
    echo $v . PHP_EOL;
    //@ob_flush();
    flush();
    $time                                    = microtime(true);
    $h                                       = hash($v, $data, false);
    $time                                    = microtime(true) - $time;
    $results[$time * 1000000000][strlen($h)] = "$v (hex)";
    $time                                    = microtime(true);
    $h                                       = hash($v, $data, true);
    $time                                    = microtime(true) - $time;
    $results[$time * 1000000000][strlen($h)] = "$v (raw)";
}
ksort($results);
echo PHP_EOL . PHP_EOL . 'Results: ' . PHP_EOL;
$i = 1;
foreach ( $results as $k => $v ) {
    foreach ( $v as $k1 => $v1 ) {
        echo ' ' . str_pad($i++ . '.', 4, ' ', STR_PAD_LEFT) . '  ' . str_pad($v1, 30, ' ') . str_pad($k1, 5, ' ') . ($k / 1000) . ' microseconds' . PHP_EOL;
    }
}