<?php

namespace UAM\CookieConsent\CookieConsentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UAMCookieConsentExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->loadCookiePolicy($config, $container, $loader);
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        // Configure Twig if TwigBundle is activated and the option
        if (true === isset($bundles['TwigBundle'])) {
            $this->configureTwigBundle($container);
        }

        if (true === isset($bundles['AsseticBundle'])) {
            $this->configureAsseticAssets($container, $config);
        }

        if (true === isset($bundles['MabaWebpaclBundle'])) {
            $this->configureMabaWebpackBundle($container, $config);
        }
    }

    protected function configureAsseticAssets($container, $config)
    {
        $container->prependExtensionConfig(
            'assetic',
            array(
                'assets' => array(
                    'uam_cookie_consent_css' => array(
                        'inputs' => array(
                            'bundles/uamcookieconsent/css/cookie-consent.css',
                        ),
                    ),
                    'uam_cookie_consent_js' => array(
                        'inputs' => array(
                            'bundles/uamcookieconsent/js/cookie-consent.js',
                        ),
                    ),
                ),
            )
        );
    }

    protected function configureMabaWebpackBundle($container, $config)
    {
        $container->prependExtensionConfig(
            'maba_webpack',
            array(
                'aliases' => array(
                    'additional' => array(
                        'uam_cookie_consent' => '%kernel.root_dir%/../vendor/uam/cookie-consent-bundle/Resources/public',
                    ),
                ),
            )
        );
    }

    protected function loadCookiePolicy($config, $container, $loader)
    {
        if (empty($config) || $config['enabled'] === false) {
            $container->setParameter(
                'uam.cookie_consent.enabled',
                false
            );

            return;
        }

        $container->setParameter(
            'uam.cookie_consent.enabled',
            true
        );

        $container->setParameter(
            'uam.cookie_consent.cookie_name',
            $config['cookie_name']
        );

        $container->setParameter(
            'uam.cookie_consent.cookie_expiry',
            $config['cookie_expiry']
        );

        $container->setParameter(
            'uam.cookie_consent.template',
            $config['template']
        );
    }
}
