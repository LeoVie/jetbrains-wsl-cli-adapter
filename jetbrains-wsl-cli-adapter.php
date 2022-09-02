<?php

declare(strict_types=1);

$windowsCmdPath = $argv[1];
$cmdPath = windowsPathToWSLMountPath($windowsCmdPath);
$phpStormPath = windowsPathToWSLMountPath(extractPhpStormExePathFromScript($cmdPath));
$phpStormArgs = buildPhpStormArgs($argv);

callPhpStorm($phpStormPath, $phpStormArgs);

function windowsPathToWSLMountPath(string $windowsPath): string
{
    $pattern = '@^(\w+):\\\\(.+)@';
    preg_match($pattern, $windowsPath, $matches);

    $drive = $matches[1];
    $path = $matches[2];

    return sprintf(
        '/mnt/%s/%s',
        strtolower($drive),
        str_replace('\\', '/', $path)
    );
}

function extractPhpStormExePathFromScript(string $scriptPath): string
{
    $pattern = '@start "" %waitarg% (\w+:\\\\.+) %ideargs%@';

    preg_match($pattern, file_get_contents($scriptPath), $matches);

    return $matches[1];
}

function buildPhpStormArgs(array $phpArgs): array
{
    array_shift($phpArgs);
    array_shift($phpArgs);

    return $phpArgs;
}

function callPhpStorm(string $phpStormPath, array $phpStormArgs): void
{
    $command = sprintf(
        '%s %s',
        $phpStormPath,
        join(' ', $phpStormArgs)
    );

    shell_exec($command);
}
