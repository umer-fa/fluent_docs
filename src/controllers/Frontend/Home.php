<?php
declare(strict_types=1);

namespace App\Controllers\Frontend;

use App\Kernel\FrontendController;

/**
 * Class Home
 * @package App\Controllers\Frontend
 */
class Home extends FrontendController
{
    /**
     * @throws \Comely\App\Exception\AppDirectoryException
     * @throws \Comely\App\Exception\ServiceNotConfiguredException
     * @throws \Comely\Translator\Exception\TranslatorException
     */
    public function frontendCallback(): void
    {
        $this->app->services()->translator()->load()
            ->sitemap();
    }

    /**
     * @throws \Comely\App\Exception\AppDirectoryException
     * @throws \Comely\App\Exception\XSRF_Exception
     * @throws \Comely\Knit\Exception\KnitException
     * @throws \Comely\Knit\Exception\TemplateException
     */
    public function get(): void
    {
        $this->page()->title(__k('sitemap.home.title'))
            ->index(1);

        $template = $this->template("home.knit")
            ->assign("remote", $this->remote());
        $this->body($template);
    }
}