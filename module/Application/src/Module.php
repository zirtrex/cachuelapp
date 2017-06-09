<?php

namespace Application;

class Module
{
    const VERSION = '1.1 Dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
