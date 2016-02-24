<?php

interface ModuleInterface
{
    public function display(string $path);

    public function redirect(string $path);
}
