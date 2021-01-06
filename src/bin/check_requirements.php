<?php
declare(strict_types=1);

namespace bin;

use App\Kernel\AppScript;

/**
 * Class check_requirements
 * @package bin
 */
class check_requirements extends AppScript
{
    public const DISPLAY_HEADER = false;
    public const DISPLAY_LOADED_NAME = true;
    public const DISPLAY_TRIGGERED_ERRORS = true;

    /**
     * @throws \AppException
     */
    public function exec(): void
    {
        // PHP version
        $this->inline("Checking PHP version... ");
        $phpVersion = PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION;
        if (PHP_VERSION_ID >= 70100) {
            $this->print("[{yellow}{b}" . $phpVersion . "{/}] {green}OK{/}");
        } else {
            $this->print("[{red}" . $phpVersion . "{/}]");
            throw new \AppException('PHP version 7.1 or better is required');
        }

        $this->microSleep(200);
        $this->checkExt("PDO");
        $this->checkExt("BcMath");
        $this->checkExt("MbString");
        $this->checkExt("JSON");
        $this->checkExt("OpenSSL");
        $this->checkExt("Curl");
    }

    /**
     * @param string $ext
     * @param int $sleep
     * @throws \AppException
     */
    private function checkExt(string $ext, int $sleep = 200): void
    {
        $this->inline(sprintf('{grey}PHP extension {cyan}%s{/} {grey}...{/} ', $ext));
        if (!extension_loaded(strtolower($ext))) {
            throw new \AppException(sprintf('PHP extension "{cyan}%s{/}" is not loaded', $ext));
        }

        $this->print('{green}OK{/}', $sleep);
    }
}