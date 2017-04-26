<?php

namespace UAM\CookieConsent\CookieConsentBundle\Twig\Extension;

use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;
use UAM\CookieConsent\CookieConsentBundle\Renderer\RendererInterface;

class CookieConsentExtension extends Twig_Extension
{
    protected $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getName()
    {
        return 'uam_cookie_consent';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction(
                'uam_cookie_consent',
                array($this, 'cookie_consent'),
                array(
                    'needs_environment' => true,
                    'is_safe' => array('html'),
                )
            ),
        );
    }

    public function cookie_consent(Twig_environment $env, array $options = array())
    {
        return $this->getRenderer()->render($options);
    }

    protected function getRenderer()
    {
        return $this->renderer;
    }

    protected function getRequestStack()
    {
        return $this->request_stack;
    }

    protected function getCurrentRequest()
    {
        return $this->getRequestStack()
            ->getCurrentRequest();
    }
}
