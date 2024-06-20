<?php

class Cache {
    private $cacheDir = __DIR__ . '/cache/';

    public function __construct() {
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function set($key, $data, $expiry) {
        $cacheFile = $this->cacheDir . md5($key) . '.cache';
        $cacheData = [
            'expiry' => time() + $expiry,
            'data' => $data
        ];
        file_put_contents($cacheFile, serialize($cacheData));
    }

    public function get($key) {
        $cacheFile = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($cacheFile)) {
            $cacheData = unserialize(file_get_contents($cacheFile));
            if ($cacheData['expiry'] >= time()) {
                return $cacheData['data'];
            } else {
                unlink($cacheFile);
            }
        }
        return null;
    }
}
