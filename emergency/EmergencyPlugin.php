<?php
/**
 * Emergency Mode plugin for Craft CMS
 *
 * Emergency Mode - show a custom emergency page when visitors come to your site
 *
 *
 * @author    Moresoda
 * @copyright Copyright (c) 2018 Moresoda
 * @link      https://moresoda.co.uk
 * @package   Emergency Mode
 * @since     1.0.0
 */

namespace Craft;

class EmergencyPlugin extends BasePlugin
{
    public function init()
    {
        parent::init();
        $settings = craft()->plugins->getPlugin('emergency')->getSettings();
        if( $settings->emergencyactivate == "1"){
            if(craft()->request->isSiteRequest()){
                craft()->emergency->showEmergencyPageService();
            }
            if(craft()->request->isCpRequest()){
                craft()->emergency->includeCpResourcesService();
            }
        }
    }

    public function getName()
    {
         return Craft::t('Emergency Mode');
    }

    public function getDescription()
    {
        return Craft::t('Show a custom emergency page when visitors come to your site.');
    }


    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/moresoda/emergency/master/releases.json';
    }

    public function getVersion()
    {
        return '1.0';
    }

    public function getSchemaVersion()
    {
        return '1.0.0';
    }


    public function getDeveloper()
    {
        return 'Moresoda';
    }


    public function getDeveloperUrl()
    {
        return 'https://moresoda.co.uk';
    }

    /**
     * Returns whether the plugin should get its own tab in the CP header.
     *
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }


    public function onBeforeInstall()
    {
    }


    public function onAfterInstall()
    {
    }

    public function onBeforeUninstall()
    {
    }


    public function onAfterUninstall()
    {
    }


    protected function defineSettings()
    {
        return array(
            'emergencyactivate' => array(AttributeType::String, 'label' => 'Enable emergency page', 'default' => false),
            'emergencytemplate' => array(AttributeType::String, 'label' => 'Template path', 'default' => ''),
        );
    }

    public function getSettingsHtml()
    {
       return craft()->templates->render('emergency/Emergency_Settings', array(
           'settings' => $this->getSettings()
       ));
    }


    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }


    public function modifyCpNav(&$nav)
    {   

        if (craft()->userSession->isAdmin())
        {   
            $icon = UrlHelper::getResourceUrl('emergency/images/emergencyicon.svg');
            $nav['emergency'] = array(
                'label' => 'Emergency Mode', 
                'url' => 'settings/plugins/emergency',
               // 'icon' => $icon
            );
        }    
    }

}