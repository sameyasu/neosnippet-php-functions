<?php
$functions_fp = fopen('functions.txt', 'rb');
$descriptions_fp = fopen('descriptions.txt', 'rb');
$ngwords_fp = fopen('ngwords.txt', 'rb');
$excludes_fp = fopen('exclude_prefixes.txt', 'rb');

$dic = [];
while (($line = fgets($descriptions_fp)) !== false) {
    $line = rtrim($line);
    if (preg_match('/^([a-z0-9_]+) — (.+)$/', $line, $matches) === 1) {
        $dic[ $matches[1] ] = $matches[2];
    }
}

$ngwords = [];
while (($line = fgets($ngwords_fp)) !== false) {
    $line = trim($line);
    $ngwords[$line] = $line;
}

$exclude_prefixes = [];
while (($line = fgets($excludes_fp)) !== false) {
    $line = trim($line);
    $exclude_prefixes[$line] = $line;
}

function excludes(string $function_name)
{
    global $exclude_prefixes;
    foreach ($exclude_prefixes as $prefix) {
        if (strpos($function_name, $prefix) === 0) {
            return true;
        }
    }
    return false;
}

$snippets = [];
while (($line = fgets($functions_fp)) !== false) {
    $line = trim($line);
    if (preg_match('/\A[A-Z]+/', $line) !== 1 && preg_match('/::/', $line) !== 1) {
        $line = preg_replace('/\s*\( void \)/', '()', $line);
        $line = preg_replace('/ : void/', '', $line);
        $line = preg_replace('/ : ([a-zA-Z0-9_]+)$/', '', $line);
        $line = preg_replace('/[\[\]]/', '', $line);
        $line = preg_replace('/\s+\(\s+/', '(', $line);
        $line = preg_replace('/\s+\)/', ')', $line);
        $line = preg_replace('/\s+,/', ',', $line);
        preg_match('/^([a-z0-9_]+)/', $line, $matches);
        $func = $matches[1];
        if (in_array($func, $ngwords, true) === false && excludes($func) === false) {
            if (preg_match('/\((.+)\)/', $line, $matches) === 1) {
                $args = preg_split('/\s*,\s*/', $matches[1]);
                $line = sprintf(
                    '%s(%s)',
                    $func,
                    implode(
                        ', ',
                        array_map(
                            function ($v, $k) {
                                return '${' . ($k + 1) . ':#:' . $v . '}';
                            },
                            array_values($args),
                            array_keys($args)
                        )
                    )
                );
            }
            $snippets[$func] = $line;
        }
    }
}

foreach ($snippets as $func => $line) {
    echo 'snippet ' . $func . PHP_EOL;
    echo 'options head' . PHP_EOL;
    if (isset($dic[$func])) {
        echo 'abbr ' . $dic[$func] . PHP_EOL;
    }
    echo "    " . $line . PHP_EOL;
    echo PHP_EOL;
}
