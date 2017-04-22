<?php

namespace UAM\CookieConsent\CookieConsentBundle\Renderer;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DefaultRenderer implements RendererInterface
{
    use ContainerAwareTrait;

    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    public function render(array $options = array())
    {
        if (!$this->isEnabled()) {
            return '';
        }

        if (array_key_exists('template', $options)) {
            $template = $options['template'];

            unset($options['template']);
        } else {
            $template = $this->getDefaultTemplate();
        }

        $data = array_merge(
            $this->getDefaults(),
            $options
        );

        return $this->getTemplating()->render($template, $data);
    }

    protected function getTemplating()
    {
        return $this->container->get('templating');
    }

    protected function getDefaults()
    {
        return array(
            'cookie_name' => $this->container->getParameter('uam.cookie_consent.cookie_name'),
            'cookie_expiry' => $this->container->getParameter('uam.cookie_consent.cookie_expiry'),
        );
    }

    protected function getDefaultTemplate()
    {
        return $this->container->getParameter('uam.cookie_consent.template');
    }

    protected function isEnabled()
    {
        return $this->container->getParameter('uam.cookie_consent.enabled');
    }
}
