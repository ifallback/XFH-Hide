<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class HideUsersExc extends AbstractTag
{
    /**
     * @param $tagChildren
     * @param $tagOption
     * @param $tag
     * @param array $options
     * @param XF\BbCode\Renderer\AbstractRenderer $renderer
     * @return string
     */
    public static function render($tagChildren, $tagOption, $tag, array $options, XF\BbCode\Renderer\AbstractRenderer $renderer)
    {
        $canView = false;
        $usersMatch = XF::app()->repository('XF:User')->getUsersByNames(explode(', ', $tagOption));
        $userLinks = [];

        foreach ($usersMatch as $user)
        {
            $userLinks[] = XF::app()->templater()->func('username_link', [$user, true]);

            if (XF::visitor()->user_id != $user->user_id && XF::visitor()->user_id)
            {
                $canView = true;
            }

        }

        if ($canView || self::canBypassHide($options))
        {
            return self::renderTemplate(
                $renderer->renderSubTree($tagChildren, $options),
                XF::phrase("xfh_hide_hidden_content_from_users_x", [
                    "users" => implode(', ', $userLinks)
                ])->render("raw"),
                []
            );
        }

        return self::renderError(
            XF::phrase("xfh_hide_hidden_content_from_users_x", [
                "users" => implode(', ', $userLinks)
            ])->render("raw")
        );
    }
}