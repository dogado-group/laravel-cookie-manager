<?php

namespace Dogado\Laravel\CookieManager\Policies;

use Browser;

class BrowserPolicy
{
    /** @var Browser */
    private $browser;

    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    public function canHaveAttributeSameSite(): bool
    {
        switch ($this->browser->getBrowser()) {
            case Browser::BROWSER_CHROME:
                return $this->browserVersionGreaterThen(51);
            case Browser::BROWSER_FIREFOX:
                return $this->browserVersionGreaterThen(60);
            case Browser::BROWSER_OPERA:
                return $this->browserVersionGreaterThen(39);
            default:
                return false;
        }
    }

    private function browserVersionGreaterThen(int $versionToCheck): bool
    {
        $matches = null;
        if (!preg_match('/^(?<mainVersion>\d+)/', $this->browser->getVersion(), $matches)) {
            return false;
        }

        return (int) $matches['mainVersion'] >= $versionToCheck;
    }
}
