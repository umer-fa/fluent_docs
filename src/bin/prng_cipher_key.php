<?php
declare(strict_types=1);

namespace bin;

use App\Kernel\AppScript;
use Comely\Utils\Security\PRNG;

/**
 * Class PRNG_Cipher_Key
 * @package bin
 */
class PRNG_Cipher_Key extends AppScript
{
    public const DISPLAY_HEADER = false;
    public const DISPLAY_LOADED_NAME = true;
    public const DISPLAY_TRIGGERED_ERRORS = false;

    /**
     * @throws \AppException
     * @throws \Comely\Utils\Security\Exception\PRNG_Exception
     */
    public function exec(): void
    {
        $bits = $this->args()->get(1) ?? 256;
        $bits = intval($bits);
        if ($bits % 8 !== 0) {
            throw new \AppException('Invalid number of bits; Bits length must be divisible by 8');
        } elseif ($bits > 512) {
            throw new \AppException('Entropy bit length cannot exceed 512');
        }

        $this->print("{grey}Generating secure entropy...{/}");
        $entropy = PRNG::randomBytes($bits / 8);
        $this->inline("{b}");
        $this->typewrite($entropy->base16()->hexits(), 75, true);
        $this->print("");
    }
}