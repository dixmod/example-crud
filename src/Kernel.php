<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Class Kernel
 * @package App
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @param string $environment
     * @param bool $debug
     */
    public function __construct(string $environment, bool $debug)
    {
        date_default_timezone_set('Europe/Moscow');
        parent::__construct($environment, $debug);
    }
}
