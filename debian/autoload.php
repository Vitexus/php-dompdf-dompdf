<?php

declare(strict_types=1);

require_once '/usr/share/php/Composer/InstalledVersions.php';
require_once '/usr/share/php/FontLib/autoload.php';
require_once '/usr/share/php/Svg/autoload.php';
require_once '/usr/share/php/Masterminds/HTML5/autoload.php';

spl_autoload_register(function (string $class): void {
    $prefix = 'Dompdf\\';
    if (str_starts_with($class, $prefix)) {
        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
        // PSR-4: src/ classes
        $file = '/usr/share/php/Dompdf/' . $relative . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
        // Classmap: lib/ classes (e.g. Cpdf)
        $file = '/usr/share/php/Dompdf/lib/' . $relative . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

(function (): void {
    $versions = [];
    foreach (\Composer\InstalledVersions::getAllRawData() as $d) {
        $versions = array_merge($versions, $d['versions'] ?? []);
    }
    $name    = 'unknown';
    $version = '0.0.0';
    $versions[$name] = ['pretty_version' => $version, 'version' => $version,
        'reference' => null, 'type' => 'library', 'install_path' => __DIR__,
        'aliases' => [], 'dev_requirement' => false];
    \Composer\InstalledVersions::reload([
        'root' => ['name' => $name, 'pretty_version' => $version, 'version' => $version,
            'reference' => null, 'type' => 'library', 'install_path' => __DIR__,
            'aliases' => [], 'dev' => false],
        'versions' => $versions,
    ]);
})();
