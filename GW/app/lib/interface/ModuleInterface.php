<?php

interface ModuleInterface
{
    public function display(string $path, string $query);

    public function redirect(string $path);

    public function ins();


}
