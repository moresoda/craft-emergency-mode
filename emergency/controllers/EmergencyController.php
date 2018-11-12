<?php
/**
 * Emergency! plugin for Craft CMS
 *
 * Emergency Controller
 *
 * --snip--
 * Generally speaking, controllers are the middlemen between the front end of the CP/website and your plugin’s
 * services. They contain action methods which handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering post data, saving it on a model,
 * passing the model off to a service, and then responding to the request appropriately depending on the service
 * method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what the method does (for example,
 * actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 * --snip--
 *
 * @author    Moresoda
 * @copyright Copyright (c) 2018 Moresoda
 * @link      https://moresoda.co.uk
 * @package   Emergency
 * @since     1
 */

namespace Craft;

class EmergencyController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex', 'actionIsActive'
        );

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/emergency
     */
    public function actionIndex()
    {   
        $settings = craft()->plugins->getPlugin('emergency')->getSettings();
        if(!craft()->request->isCpRequest() && $settings->emergencyactivate == true){
            $this->renderTemplate($settings->emergencytemplate);
        }
    }

    public function actionIsActive()
    {
        return craft()->plugins->getPlugin('emergency')->getSettings()->emergencyactivate;
    }
}