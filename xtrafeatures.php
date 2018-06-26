<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class XtraFeaturesPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.xtrafeatures.built_in_css')) {
            $this->grav['assets']->addCss('plugin://xtrafeatures/css/xtrafeatures.css');
        }
        if ($this->config->get('plugins.xtrafeatures.show_slideLatest')) {
            $this->grav['assets']->addCss('plugin://xtrafeatures/css/lightslider.css');
            $this->grav['assets']->addJs('plugin://xtrafeatures/js/lightslider.min.js');
        }
        if ($this->config->get('plugins.xtrafeatures.fontawesome')) {
            $this->grav['assets']->addCss("//use.fontawesome.com/releases/v5.1.0/css/all.css");
        }
    }
}
