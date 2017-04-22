<?php

namespace UAM\CookieConsent\CookieConsentBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Symfony\Component\HttpFoundation\RequestStack;
use UAM\CookieConsent\CookieConsentBundle\Policy\DefaultPolicy;

class CookieConsentExtension extends Twig_Extension
{
    protected $request_stack;

    protected $policy;

    public function __construct(RequestStack $request_stack, PolicyInterface $policy)
    {
        $this->request_stack = $request_stack;

        $this->policy = $policy;
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
                    'is_safe' => array('html'),
                )
            ),
        );
    }

    public function cookie_consent(array $options = array())
    {
        if (!$this->getCurrentRequest()->cookies->has('uam_cookie_consent')) {
            return $this->getPolicy()->render($options);
        }
    }

    protected function getPolicy()
    {
        return $this->policy;
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
