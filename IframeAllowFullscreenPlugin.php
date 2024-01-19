<?php

/**
 * @package IframeAllowFullscreen
 */

class IframeAllowFullscreenPlugin extends Omeka_Plugin_AbstractPlugin {
    protected $_hooks = array(
    );
    protected $_filters = array(
        'html_purifier_config_setup',
    );

    public function filterHtmlPurifierConfigSetup($purifierConfig, $args) {
        $allowedHtmlElements = $args['allowedHtmlElements'];
        if (!in_array('iframe', $allowedHtmlElements)) {
            array_push($allowedHtmlElements, 'iframe');
            $purifierConfig->set('HTML.AllowedElements', $allowedHtmlElements);
        }
        $allowedHtmlAttributes = $args['allowedHtmlAttributes'];
        if (!in_array('iframe.allowfullscreen', $allowedHtmlAttributes)) {
            array_push($allowedHtmlAttributes, 'iframe.allowfullscreen');
            $purifierConfig->set('HTML.AllowedAttributes', $allowedHtmlAttributes);
        }
        $definition = $purifierConfig->getHTMLDefinition(true);
        $definition->addAttribute('iframe', 'allowfullscreen', 'Bool#allowfullscreen');
        return $purifierConfig;
    }
}
