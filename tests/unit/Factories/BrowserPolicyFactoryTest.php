<?php

namespace App\Tests\unit\Factories\Policies;

use App\Tests\unit\TestCase;
use Browser;
use Dogado\Laravel\CookieManager\Factories\BrowserFactory;
use Dogado\Laravel\CookieManager\Factories\BrowserPolicyFactory;
use Dogado\Laravel\CookieManager\Policies\BrowserPolicy;
use Symfony\Component\HttpFoundation\Request;

class BrowserPolicyFactoryTest extends TestCase
{
    public function testCreateByRequest()
    {
        $browserFactory = $this->createMock(BrowserFactory::class);
        $browser = $this->createMock(Browser::class);
        $request = $this->createMock(Request::class);
        $browserFactory->expects(self::once())->method('createByRequest')->with($request)
            ->willReturn($browser);

        $browserPolicyFactory = new BrowserPolicyFactory($browserFactory);
        $browserPolicy = new BrowserPolicy($browser);

        $this->assertEquals($browserPolicy, $browserPolicyFactory->createByRequest($request));
    }

}
