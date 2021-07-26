<?php

namespace App\Tests\unit\Policies;

use App\Tests\unit\TestCase;
use Browser;
use Dogado\Laravel\CookieManager\Policies\BrowserPolicy;
use PHPUnit\Framework\MockObject\MockObject;

class BrowserPolicyTest extends TestCase
{
    /**
     * @var Browser|MockObject
     */
    private $browser;
    /**
     * @var BrowserPolicy
     */
    private $policy;

    public function setUp(): void
    {
        $this->browser = $this->createMock(Browser::class);
        $this->policy = new BrowserPolicy($this->browser);
    }

    public function testCanHaveAttributeSameSiteBrowserChromeTrueTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_CHROME);
        $this->browser->method('getVersion')->willReturn('51.loremIpsum.74566.455');
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(true, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserChromeFalseTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_CHROME);
        $this->browser->method('getVersion')->willReturn(28);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(false, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserFirefoxTrueTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_FIREFOX);
        $this->browser->method('getVersion')->willReturn(61);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(true, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserFirefoxFalseTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_FIREFOX);
        $this->browser->method('getVersion')->willReturn(28);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(false, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserOperaTrueTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_OPERA);
        $this->browser->method('getVersion')->willReturn(51);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(true, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserOperaFalseTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_OPERA);
        $this->browser->method('getVersion')->willReturn(28);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(false, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserDefaultTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_UNKNOWN);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(false, $result);
    }

    public function testCanHaveAttributeSameSiteBrowserWithoutMatchTest()
    {
        $this->browser->method('getBrowser')->willReturn(Browser::BROWSER_OPERA);
        $this->browser->method('getVersion')->willReturn($this->getFaker()->name);
        $result = $this->policy->canHaveAttributeSameSite();

        $this->assertEquals(false, $result);
    }
}
