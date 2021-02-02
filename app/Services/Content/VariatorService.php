<?php

namespace App\Services\Content;

class VariatorService
{
    /**
     * @param string $text
     * @param bool $num
     * @return string
     */
    public function variate(string $text, bool $num = false): string
    {
        $ok = 1;
        if (strpos($text, '^{') !== false && $num === false) {
            $text = str_replace('^{', '{', $text);
        }
        while (strpos($text, '{') !== false && $ok) {
            $ok = 0;
            if (preg_match("/^.*\+,\{([^\{\}]*)\}.*$/sD", $text)) {
                $b = preg_replace("/^.*\+,\{([^\{\}]*)\}.*$/sD", "\\1", $text);
                $text = str_replace('+,{' . $b . '}', $this->tails($b, ', '), $text);
                $ok = 1;
            } elseif (preg_match("/^.*\+;\{([^\{\}]*)\}.*$/sD", $text)) {
                $b = preg_replace("/^.*\+;\{([^\{\}]*)\}.*$/sD", "\\1", $text);
                $text = str_replace('+;{' . $b . '}', $this->tails($b, '; '), $text);
                $ok = 1;
            } elseif (preg_match("/^.*\+\{([^\{\}]*)\}.*$/sD", $text)) {
                $b = preg_replace("/^.*\+\{([^\{\}]*)\}.*$/sD", "\\1", $text);
                $text = str_replace('+{' . $b . '}', $this->tails($b, ' '), $text);
                $ok = 1;
            } elseif (preg_match("/^.*\^\{([^\{\}]*)\}.*$/sD", $text)) {
                $b = preg_replace("/^.*\^\{([^\{\}]*)\}.*$/sD", "\\1", $text);
                $text = str_replace('^{' . $b . '}', $this->tail($b, $num), $text);
                $ok = 1;
            } elseif (preg_match("/^.*\{([^\{\}]*)\}.*$/sD", $text)) {
                $b = preg_replace("/^.*\{([^\{\}]*)\}.*$/sD", "\\1", $text);
                $text = str_replace('{' . $b . '}', $this->tail($b), $text);
                $ok = 1;
            }
        }
        $text = preg_replace("/([\{\|\}])/s", "<font color=\"#FF0000\" style=\"font-size:120%\">\\1</font>", $text);
        return preg_replace("/[[:space:]]*(,)[[:space:]]*/s", "\\1 ", $text);
    }

    /**
     * @param string $text
     * @param bool $num
     * @return string
     */
    private function tail(string $text, bool $num = false): string
    {
        $tail = explode('|', $text);
        $tails = count($tail);
        if ($num >= $tails) {
            $num = $tails - 1;
        }
        if ($num === false || $num < 0) {
            $num = floor(rand(0, $tails - 0.001));
        }
        return $tail[$num];
    }

    /**
     * @param string $text
     * @param string $s
     * @return string
     */
    private function tails(string $text, string $s): string
    {
        $text = preg_replace("/\|$/sD", '', preg_replace("/^\|/sD", '', preg_replace("/\|\|+/s", "|", $text)));
        $tail = explode('|', $text);
        shuffle($tail);
        return implode($s, $tail);
    }

}
