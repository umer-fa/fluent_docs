<?php
declare(strict_types=1);

namespace bin;

use App\Kernel\AppScript;

/** @noinspection PhpUndefinedClassInspection */

/**
 * Class console
 * @package bin
 */
class Console extends AppScript
{
    public function exec(): void
    {
        $this->print("{grey}To execute an App script, enter script name and arguments followed by console executable:{/}");
        $this->print("./console {magenta}{b}some_script {grey}arg1 arg2{/}");
        $this->print("");
        $this->print("Following scripts are available to run:");
        $this->print("┬ {cyan}{b}prng_cipher_key{/} {grey}256{/} ── Generates a cryptographically secure entropy");
        $this->print("├ {cyan}{b}deploy_db{/} ── Runs DB migrations");
        $this->print("└ {cyan}{b}check_requirements{/} ── Checks for all prerequisites");
    }
}