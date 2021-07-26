<?php

namespace App\Tests\unit\Factories\Policies;

use App\Tests\unit\TestCase;
use Browser;
use Dogado\Laravel\CookieManager\Factories\BrowserFactory;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;

class BrowserFactoryTest extends TestCase
{
    public function testCreateByRequest()
    {
        $userAgent = $this->getFaker()->userAgent;
        $request = $this->createMock(Request::class);
        $headerBag = $this->createMock(HeaderBag::class);
        $headerBag->expects(self::once())->method('get')->with('User-Agent', '')->willReturn($userAgent);
        $request->headers = $headerBag;

        $createdBrowser = (new BrowserFactory())->createByRequest($request);
        $this->assertEquals($userAgent, $createdBrowser->getUserAgent());
    }

}
