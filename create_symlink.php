<?php
// Buat direktori jika belum ada
if (!file_exists('public/storage')) {
    mkdir('public/storage', 0755, true);
}

// Salin file dari storage/app/public ke public/storage
$source = 'storage/app/public';
$dest = 'public/storage';

function copyDir($src, $dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copyDir($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

copyDir($source, $dest);
echo "Storage link created manually!";
