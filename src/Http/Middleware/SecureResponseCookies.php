<?php

namespace Dogado\Laravel\CookieManager\Http\Middleware;

use Closure;
use Dogado\Laravel\CookieManager\Factories\BrowserPolicyFactory;
use Dogado\Laravel\CookieManager\Policies\BrowserPolicy;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureResponseCookies
{
    /** @var BrowserPolicyFactory */
    protected $browserPolicyFactory;

    /** @var BrowserPolicy|null */
    protected $browserPolicy = null;

    public function __construct(BrowserPolicyFactory $browserPolicyFactory)
    {
        $this->browserPolicyFactory = $browserPolicyFactory;
    }

    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->browserPolicy = $this->browserPolicyFactory->createByRequest($request);
        return $this->secureCookies($next($request), $request->isSecure());
    }

    /**
     * Try to modify all response header cookies and replace them with secured attributes
     *
     * @param Response $response
     * @param bool $setSecureAttribute
     * @return Response
     */
    protected function secureCookies(Response $response, bool $setSecureAttribute): Response
    {
        foreach ($response->headers->getCookies() as $cookie) {
            $response->headers->setCookie($this->getSecureDuplicatedCookie($cookie, $setSecureAttribute));
        }

        return $response;
    }

    /**
     * Generate a duplicated cookie and set secured attributes if the client agent supports it.
     * @param Cookie $cookie
     * @param bool $setSecureAttribute
     * @return Cookie
     */
    protected function getSecureDuplicatedCookie(Cookie $cookie, bool $setSecureAttribute): Cookie
    {
        $sameSite = $cookie->getSameSite();
        if ($this->browserPolicy && $this->browserPolicy->canHaveAttributeSameSite() && $setSecureAttribute) {
            $sameSite = Cookie::SAMESITE_NONE;
        }

        return new Cookie(
            $cookie->getName(),
            $cookie->getValue(),
            $cookie->getExpiresTime(),
            $cookie->getPath(),
            $cookie->getDomain(),
            $setSecureAttribute,
            $cookie->isHttpOnly(),
            $cookie->isRaw(),
            $sameSite
        );
    }
}
