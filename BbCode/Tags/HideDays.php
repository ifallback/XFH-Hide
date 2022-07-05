<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class HideDays extends AbstractTag
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
        $daysNeed = intval($tagOption);
        $userRegisterDate = intval((XF::$time - XF::visitor()->register_date) / 86400);

        if ($daysNeed <= $userRegisterDate || self::canBypassHide($options))
        {
            return self::renderTemplate(
                $renderer->renderSubTree($tagChildren, $options),
                XF::phrase('xfh_hide_hidden_content_by_number_of_days', [
                    'now' => $userRegisterDate,
                    'need' => $daysNeed
                ]), []
            );
        }

        return self::renderError(
            XF::phrase('xfh_hide_hidden_content_by_number_of_days', [
                'now' => $userRegisterDate,
                'need' => $daysNeed
            ])
        );
    }
}