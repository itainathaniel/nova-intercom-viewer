<?php

namespace Itainathaniel\IntercomViewer;

use Laravel\Nova\ResourceTool;

class IntercomViewer extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Intercom';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'intercom-viewer';
    }

    public function hideAvatar()
    {
        return $this->withMeta(['hide_field_avatar' => true]);
    }

    public function hideId()
    {
        return $this->withMeta(['hide_field_id' => true]);
    }

    public function hideEmail()
    {
        return $this->withMeta(['hide_field_email' => true]);
    }

    public function hidePhone()
    {
        return $this->withMeta(['hide_field_phone' => true]);
    }

    public function hideName()
    {
        return $this->withMeta(['hide_field_name' => true]);
    }

    public function hideAnonymous()
    {
        return $this->withMeta(['hide_field_anonymous' => true]);
    }

    public function hidePseudonym()
    {
        return $this->withMeta(['hide_field_pseudonym' => true]);
    }

    public function hideLastseenip()
    {
        return $this->withMeta(['hide_field_lastseenip' => true]);
    }

    public function hideSessioncount()
    {
        return $this->withMeta(['hide_field_sessioncount' => true]);
    }

    public function hideUnsubscribedfromemails()
    {
        return $this->withMeta(['hide_field_unsubscribedfromemails' => true]);
    }

    public function hideMarkedemailasspam()
    {
        return $this->withMeta(['hide_field_markedemailasspam' => true]);
    }

    public function hideHashardbounced()
    {
        return $this->withMeta(['hide_field_hashardbounced' => true]);
    }

    public function hideUseragentdata()
    {
        return $this->withMeta(['hide_field_useragentdata' => true]);
    }

    public function hideAnalytics()
    {
        return $this->withMeta(['hide_field_analytics' => true]);
    }
}
