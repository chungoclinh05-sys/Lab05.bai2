<?php
function data_path(string $file): string {
    return __DIR__ . '/../data/' . $file;
}

function read_json(string $file, array $default=[]): array {
    $path = data_path($file);
    if (!file_exists($path)) return $default;
    return json_decode(file_get_contents($path), true) ?? $default;
}

function write_json(string $file, array $data): void {
    file_put_contents(data_path($file),
        json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}
