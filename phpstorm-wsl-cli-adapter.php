<?php

declare(strict_types=1);

$cmdPath = '/mnt/c/jetbrains-shell-scripts/PhpStorm.cmd';
$pattern = '@start "" %waitarg% (.):\\\\(.+) %ideargs%@';

preg_match($pattern, file_get_contents($cmdPath), $matches);

$phpstormWindowsDrive = $matches[1];
$phpstormWindowsPath = $matches[2];

$wslMountPath = sprintf(
    '/mnt/%s/%s',
    strtolower($phpstormWindowsDrive),
    str_replace('\\', '/', $phpstormWindowsPath)
);

$phpstormArgs = $argv;
array_shift($phpstormArgs);
$phpstormArgs = join(' ', $phpstormArgs);

$command = sprintf(
    '%s %s',
    $wslMountPath,
    $phpstormArgs
);

shell_exec($command);