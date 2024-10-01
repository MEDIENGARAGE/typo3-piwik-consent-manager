<?php
namespace MEDIENGARAGE\Piwikconsentmanager\ViewHelpers;

use Closure;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class GetPropertyFromAspectViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('aspect', 'string', 'Aspect to get property from.', true);
        $this->registerArgument('property', 'string', 'Property to get from aspect.', true);
    }

    /**
     * @throws AspectNotFoundException
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $context = GeneralUtility::makeInstance(Context::class);
        return $context->getPropertyFromAspect($arguments['aspect'], $arguments['property']);
    }
}
