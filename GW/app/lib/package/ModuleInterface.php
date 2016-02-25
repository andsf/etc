<?php
namespace app\lib\package;

interface ModuleInterface
{
    public function display(string $path);

    public function redirect(string $path, array $query = null);
}
