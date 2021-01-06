<?php
declare(strict_types=1);

namespace App\Kernel;

use Comely\App\Http\Controllers\GenericHttpController;
use Comely\Filesystem\Exception\PathNotExistException;
use Comely\Knit\Knit;

/**
 * Class FrontendController
 * @package App\Kernel
 */
abstract class FrontendController extends GenericHttpController
{
    /** @var Knit */
    private $knit;

    /**
     * @throws \Comely\App\Exception\AppDirectoryException
     * @throws \Comely\App\Exception\ServiceNotConfiguredException
     * @throws \Comely\App\Exception\XSRF_Exception
     * @throws \Comely\Sessions\Exception\ComelySessionException
     * @throws \Comely\Sessions\Exception\StorageException
     * @throws \Comely\Utils\Security\Exception\PRNG_Exception
     */
    public function onLoad(): void
    {
        // Global Translate Functions
        require_once "../../../vendor/comely-io/translator/src/globalTranslateFunctions.php";

        // Instantiate Sessions
        $this->initSession();

        // Set XSRF Token
        $this->page()->set_XSRF_Token();

        // Frontend callback
        $this->frontendCallback();
    }

    /**
     * @return Knit
     * @throws \AppException
     * @throws \Comely\App\Exception\AppDirectoryException
     * @throws \Comely\Filesystem\Exception\PathException
     * @throws \Comely\Filesystem\Exception\PathOpException
     */
    public function knit(): Knit
    {
        if (!$this->knit) {
            $this->knit = parent::knit();

            try {
                $frontendTemplatesDirectory = $this->app->dirs()->templates()->dir("frontend");
            } catch (PathNotExistException $e) {
                throw new \AppException('Frontend templates directory does not exit');
            }

            $this->knit->dirs()->templates($frontendTemplatesDirectory);
        }

        return $this->knit;
    }

    /**
     * @return void
     */
    abstract public function frontendCallback(): void;

    /**
     * @return void
     */
    public function onFinish(): void
    {
    }
}