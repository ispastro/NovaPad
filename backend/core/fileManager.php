<?php

class FileManager {
    private $basePath;
    private $versionPath;

    public function __construct($basePath, $versionPath) {
        $this->basePath = $basePath;
        $this->versionPath = $versionPath;
    }

    public function save($fileName, $content) {
        $filePath = $this->basePath . '/' . basename($fileName);
        
        if (file_exists($filePath)) {
            $this->saveVersion($fileName);
        }
        return file_put_contents($filePath, $content) !== false;
    }

    public function load($fileName) {
        $filePath = $this->basePath . '/' . $fileName;
        return file_exists($filePath) ? file_get_contents($filePath) : false;
    }

    public function delete($fileName) {
        $filePath = $this->basePath . '/' . $fileName;
        return file_exists($filePath) ? unlink($filePath) : false;
    }

    public function listFiles() {
        $files = array_diff(scandir($this->basePath), ['.', '..']);
        return array_values($files);
    }

    public function saveVersion($fileName) {
        $filePath = $this->basePath . '/' . $fileName;
        $versionFolder = $this->versionPath . '/' . pathinfo($fileName, PATHINFO_FILENAME);

        if (!is_dir($versionFolder)) {
            mkdir($versionFolder, 0777, true);
        }

        $timestamp = date("Y-m-d_H-i-s");
        copy($filePath, $versionFolder . '/' . $timestamp . '.html');
    }
}
?>
