<?php
namespace OSW3\Ecommerce\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\Ecommerce\Twig\Runtime\TranslationExtensionRuntime;

class TranslationExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('translation', [TranslationExtensionRuntime::class, 'getTranslation'], ['is_safe' => ['html']]),
        ];
    }
}
