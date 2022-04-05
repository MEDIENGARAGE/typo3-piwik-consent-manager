<?php

namespace TYPO3\CMS\Core\Context;

use TYPO3\CMS\Core\Context\Exception\AspectPropertyNotFoundException;

/**
 * The aspect contains information about a visitors data privacy consents
 */
class ConsentAspect implements AspectInterface
{
    /**
     * @var bool
     */
    protected $customConsent = false;

    /**
     * @param bool $customConsent
     */
    public function __construct(bool $customConsent = false)
    {
        $this->customConsent = $customConsent;
    }

    /**
     * Fetch common information about the user
     *
     * @param string $name
     * @return bool
     * @throws AspectPropertyNotFoundException
     */
    public function get(string $name)
    {
        switch ($name) {
            case 'customConsent':
                return $this->customConsent;
        }
        throw new AspectPropertyNotFoundException('Property "' . $name . '" not found in Aspect "' . __CLASS__ . '".', 1529996567);
    }
}
