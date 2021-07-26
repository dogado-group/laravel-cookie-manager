<?php
namespace Dogado\Laravel\CookieManager\Factories;

use Browser;
use Symfony\Component\HttpFoundation\Request;

class BrowserFactory
{
    public function createByRequest(Request $request): Browser
    {
        return new Browser((string) $request->headers->get('User-Agent', ''));
    }
}