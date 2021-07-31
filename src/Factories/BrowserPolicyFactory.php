<?php

namespace Dogado\Laravel\CookieManager\Factories;

use Dogado\Laravel\CookieManager\Policies\BrowserPolicy;
use Symfony\Component\HttpFoundation\Request;

class BrowserPolicyFactory
{
    /** @var BrowserFactory */
    protected $browserFactory;

    public function __construct(BrowserFactory $browserFactory)
    {
        $this->browserFactory = $browserFactory;
    }

    public function createByRequest(Request $request): BrowserPolicy
    {
        return new BrowserPolicy($this->browserFactory->createByRequest($request));
    }
}
