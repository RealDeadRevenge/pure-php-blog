<?php

namespace App\Core;

use Smarty\Exception;
use Smarty\Smarty;

class View
{
    /** @var Smarty */
    private Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(dirname(__DIR__, 2) . '/templates');
        $this->smarty->setCompileDir(dirname(__DIR__, 2) . '/storage/cache/templates_c');
        $this->smarty->setCacheDir(dirname(__DIR__, 2) . '/storage/cache');
        $this->smarty->setConfigDir(dirname(__DIR__, 2) . '/config');
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function assign(
        string $key,
        mixed $value
    ): void
    {
        $this->smarty->assign($key, $value);
    }

    /**
     * @param string $template
     *
     * @return void
     * @throws Exception
     */
    public function render(string $template): void
    {
        $this->smarty->display($template);
    }
}