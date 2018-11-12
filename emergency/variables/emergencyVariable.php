<?php
namespace Craft;

class EmergencyVariable
{
    public function isActive()
    {
        return craft()->plugins->getPlugin('emergency')->getSettings()->emergencyactivate;
    }
}