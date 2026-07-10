<?php
$content = file_get_contents('c:/LiveEnv\www\extremeprojecv1\resources\views\welcome.blade.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (stripos($line, 'shadow') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
