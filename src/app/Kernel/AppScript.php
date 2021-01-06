<?php
declare(strict_types=1);

namespace App\Kernel;

use Comely\App\CLI\AbstractAppScript;

/**
 * Class AppScript
 * @package App\Kernel
 */
abstract class AppScript extends AbstractAppScript
{
    /** @var \App */
    protected $app;
}