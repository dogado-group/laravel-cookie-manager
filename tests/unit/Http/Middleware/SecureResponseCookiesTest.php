<?php

namespace App\Tests\unit\Http\Middleware;

use App\Tests\unit\TestCase;
use Dogado\Laravel\CookieManager\Factories\BrowserPolicyFactory;
use Dogado\Laravel\CookieManager\Http\Middleware\SecureResponseCookies;
use Dogado\Laravel\CookieManager\Policies\BrowserPolicy;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class SecureResponseCookiesTest extends TestCase
{
    /** @var BrowserPolicy|MockObject */
    private $browserPolicy;

    /** @var BrowserPolicyFactory|MockObject */
    private $browserPolicyFactory;

    /** @var Request|MockObject */
    private $request;

    /** @var Response|MockObject */
    private $response;

    protected function setUp(): void
    {
        $this->browserPolicy = $this->createMock(BrowserPolicy::class);
        $this->request = $this->createMock(Request::class);
        $this->browserPolicyFactory = $this->createMock(BrowserPolicyFactory::class);
        $this->response = $this->createMock(Response::class);

        $headerBag = $this->createMock(ResponseHeaderBag::class);
        $this->response->headers = $headerBag;
    }

    /**
     * @dataProvider dataProvider
     * @param bool $secure
     * @param string $sameSite
     * @param bool $expectedSecure
     * @param string $expectedSameSite
     */
    public function testHandleSecureAndSameSiteTrue($secure, $sameSite, $expectedSecure, $expectedSameSite): void
    {
        $cookie = $this->generateCookie();
        $this->browserPolicyFactory->expects(self::once())->method('createByRequest')
            ->with($this->request)->willReturn($this->browserPolicy);
        /** @var ResponseHeaderBag|MockObject $headers */
        $headers = $this->response->headers;
        $headers->expects(self::once())->method('getCookies')->willReturn([$cookie]);

        $callback = function () {
            return $this->response;
        };

        $this->request->expects(self::once())->method('isSecure')->willReturn($secure);
        $this->browserPolicy->expects(self::once())->method('canHaveAttributeSameSite')->willReturn($sameSite);

        $expectedCookie = $this->expectedClonedCookie($cookie, $expectedSameSite, $expectedSecure);

        $headers->expects(self::once())->method('setCookie')->with($expectedCookie);

        $middleware = new SecureResponseCookies($this->browserPolicyFactory);
        $this->assertEquals($this->response, $middleware->handle($this->request, $callback));
    }

    public function dataProvider(): array
    {
        return [
            [true, true, true, Cookie::SAMESITE_NONE],
            [false, false, false, Cookie::SAMESITE_NONE],
            [true, false, true, Cookie::SAMESITE_NONE],
            [false, true, false, Cookie::SAMESITE_NONE],
        ];
    }

    private function generateCookie(): Cookie
    {
        $faker = $this->getFaker();
        return new Cookie(
            $faker->domainWord,
            $faker->domainWord,
            $faker->numberBetween(),
            $faker->slug,
            $faker->domainName,
            false,
            $faker->boolean,
            $faker->boolean,
            Cookie::SAMESITE_NONE
        );
    }

    private function expectedClonedCookie($cookie, string $sameSite, bool $setSecureAttribute)
    {
        return new Cookie(
            $cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(),
            $cookie->getPath(), $cookie->getDomain(), $setSecureAttribute,
            $cookie->isHttpOnly(), $cookie->isRaw(), $sameSite
        );
    }

}
