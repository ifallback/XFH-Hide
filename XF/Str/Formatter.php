<?php

namespace XFH\Hide\XF\Str;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class Formatter extends XFCP_Formatter
{
    /**
     * @param $string
     * @param array $options
     * @return string
     */
    public function stripBbCode($string, array $options = []): string
    {
        return parent::stripBbCode(AbstractTag::stripHideTags($string, 'xfh_hide_stripped_text'), $options);
    }

    /**
     * @param $string
     * @param $maxLength
     * @param array $options
     * @return array|mixed|string|string[]
     */
    public function snippetString($string, $maxLength = 0, array $options = [])
    {
        return parent::snippetString(AbstractTag::stripHideTags($string, XF::phrase('xfh_hide_stripped_text')), $maxLength, $options);
    }

    /**
     * @param $bbCode
     * @param $context
     * @return string
     */
    public function getBbCodeForQuote($bbCode, $context): string
    {
        return parent::getBbCodeForQuote(AbstractTag::stripHideTags($bbCode, XF::phrase('xfh_hide_stripped_text')), $context);
    }
}