<?php
/**
 * Emergency! plugin for Craft CMS
 *
 * Emergency Service
 *
 * --snip--
 * All of your plugin’s business logic should go in services, including saving data, retrieving data, etc. They
 * provide APIs that your controllers, template variables, and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 * --snip--
 *
 * @author    Moresoda
 * @copyright Copyright (c) 2018 Moresoda
 * @link      https://moresoda.co.uk
 * @package   Emergency
 * @since     1
 */

namespace Craft;

class EmergencyService extends BaseApplicationComponent
{
  
    public function showEmergencyPageService()
    {
        $settings = craft()->plugins->getPlugin('emergency')->getSettings();
        $variables=[];
        if(craft()->request->getUrl()!='/'){
            craft()->request->redirect('/',true,302);
        } else {
            $output = craft()->templates->render($settings->emergencytemplate, $variables);
            ob_start();
            echo $output;
            craft()->end();
        }
    }

    public function includeCpResourcesService()
    {
        $templatesService = craft()->templates;

        $templatesService->includeCssResource('emergency/css/Emergency_Style.css');

        $str = Craft::t('emergencyBannerMessage');
        $html = '';
        $html .= '<div id="emergencyBanner">';
        $html .= '<img id="emergencyIcon" src="/admin/resources/emergency/images/icon.svg" alt=""> ';
        $html .= '<p>'. $str .'</p>';
        $html .= '</div>';
        craft()->templates->includeFootHtml($html);
      
        $js = '$("#emergencyBanner").prependTo("main");';

        craft()->templates->includeJs($js, $first=false);
        
    }
}