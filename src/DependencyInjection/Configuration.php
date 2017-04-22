<?php

namespace UAM\CookieConsent\CookieConsentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('uam_cookie_consent');

        $rootNode
            ->children()
                ->canBeDisabled()
                ->children()
                    ->scalarNode('cookie_name')
                        ->cannotBeEmpty()
                        ->defaultValue('uam_cookie_consent')
                    ->end()
                    ->scalarNode('cookie_expiry')
                        ->cannotBeEmpty()
                        ->defaultValue(365)
                    ->end()
                    ->scalarNode('template')
                        ->cannotBeEmpty()
                        ->defaultValue('UAMCookieConsentBundle::cookie_consent.html.twig')
                    ->end()
                ->end()
            ->end()

        return $treeBuilder;
    }
}
