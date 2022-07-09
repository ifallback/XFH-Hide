<?php

namespace XFH\Hide\BbCode;

use XF;

abstract class AbstractTag
{
    abstract public static function render($tagChildren, $tagOption, $tag, array $options, XF\BbCode\Renderer\AbstractRenderer $renderer);

    /**
     * @param $options
     * @return bool
     */
    public static function canBypassHide($options): bool
    {
        $visitor = XF::visitor();

        if ($visitor->hasPermission('xfh_hide_permissions', 'bypass_all_tags'))
        {
            return true;
        }

        if ($options)
        {
            return $options['entity']['user_id'] === $visitor->user_id;
        }

        return false;
    }

    /**
     * @param $error
     * @return string
     */
    public static function renderError($error): string
    {
        return XF::app()->templater()
            ->renderTemplate('public:xfh_hide_bb_code_error', [
                'error' => $error
            ]);
    }

    /**
     * @param $content
     * @param $title
     * @param array $options
     * @return string
     */
    public static function renderTemplate($content, $title, array $options): string
    {
        return XF::app()->templater()
            ->renderTemplate('public:xfh_hide_bb_code', [
                'content' => $content,
                'title' => $title,
                'options' => $options
        ]);
    }

    /**
     * @return XF\Mvc\Entity\AbstractCollection
     */
    public static function getHideTags()
    {
        $finder = XF::finder('XF:BbCode');

        return $finder
            ->where('callback_class', 'LIKE','XFH\\\%Hide%')
            ->fetch()
            ->pluckNamed('bb_code_id');
    }

    /**
     * @param $string
     * @param string $replacetext
     * @return array|string|string[]|null
     */
    public static function stripHideTags($string, string $replacetext = ''): string
    {
        return preg_replace('#\[(' . implode ('|', self::getHideTags()) . ')(=[^\]]*)?\](.*)\[/\1\]#siU', $replacetext, $string);
    }

}