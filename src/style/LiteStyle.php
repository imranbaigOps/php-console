<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017/5/10
 * Time: 下午7:45
 */

namespace inhere\console\style;

use inhere\console\utils\Helper;

/**
 * Class LiteStyle
 * @package inhere\console\color
 */
class LiteStyle
{
    const NORMAL       = 0;

    // Foreground color
    const FG_BLACK        = 30;
    const FG_RED          = 31;
    const FG_GREEN        = 32;
    const FG_BROWN        = 33;
    const FG_BLUE         = 34;
    const FG_CYAN         = 36;
    const FG_WHITE        = 37;
    const FG_DEFAULT      = 39;

    // extra Foreground color

    const FG_DARK_GRAY        = 90;
    const FG_LIGHT_RED        = 91;
    const FG_LIGHT_GREEN      = 92;
    const FG_LIGHT_YELLOW     = 93;
    const FG_LIGHT_BLUE       = 94;
    const FG_LIGHT_MAGENTA    = 95;
    const FG_LIGHT_CYAN       = 96;
    const FG_WHITE_W          = 97;

    // Background color
    const BG_BLACK        = 40;
    const BG_RED          = 41;
    const BG_GREEN        = 42;
    const BG_BROWN        = 43;
    const BG_BLUE         = 44;
    const BG_CYAN         = 46;
    const BG_WHITE        = 47;
    const BG_DEFAULT      = 49;

    // extra Background color
    const BG_DARK_GRAY     = 100;
    const BG_LIGHT_RED     = 101;
    const BG_LIGHT_GREEN   = 102;
    const BG_LIGHT_YELLOW  = 103;
    const BG_LIGHT_BLUE    = 104;
    const BG_LIGHT_MAGENTA = 105;
    const BG_LIGHT_CYAN    = 106;
    const BG_WHITE_W       = 107;

    // color option
    const BOLD          = 1;      // 加粗
    const FUZZY         = 2;      // 模糊(不是所有的终端仿真器都支持)
    const ITALIC        = 3;      // 斜体(不是所有的终端仿真器都支持)
    const UNDERSCORE    = 4;      // 下划线
    const BLINK         = 5;      // 闪烁
    const REVERSE       = 7;      // 颠倒的 交换背景色与前景色
    const CONCEALED     = 8;      // 隐匿的

    /**
     * some defined styles
     * @var array
     */
    public static $styles = [
        'light_red'    => '1;31',
        'light_green'  => '1;32',
        'yellow'       => '1;33',
        'light_blue'   => '1;34',
        'magenta'      => '1;35',
        'light_cyan'   => '1;36',
        'white'        => '1;37',
        'normal'        => '0',
        'black'        => '0;30',
        'red'          => '0;31',
        'green'        => '0;32',
        'brown'        => '0;33',
        'blue'         => '0;34',
        'cyan'         => '0;36',
        'bold'         => '1',
        'underscore'   => '4',
        'reverse'      => '7',
    ];

    /**
     * @param $text
     * @param string|int|array $style
     * @return string
     */
    public static function color($text, $style = self::NORMAL)
    {
        return self::render($text, $style);
    }

    /**
     * @param $text
     * @param string|int|array $style
     * @return string
     */
    public static function render($text, $style = self::NORMAL)
    {
        if (!Helper::isSupportColor()) {
            return $text;
        }

        if(is_string($style)) {
            $out = self::$styles[$style] ?? self::NORMAL;
        } elseif (is_int($style)) {
            $out = $style;

            // array: [Lite::FG_GREEN, Lite::BG_WHITE, Lite::UNDERSCORE]
        } elseif (is_array($style)) {
            $out = implode(';', $style);
        } else {
            $out = self::NORMAL;
        }

//        $result = chr(27). "$out{$text}" . chr(27) . chr(27) . "[0m". chr(27);
        return "\033[{$out}m{$text}\033[0m";
    }

    /**
     * @param string $text
     * @return string
     */
    public static function clear($text): string
    {
        // return preg_replace('/\033\[(?:\d;?)+m/', '' , "\033[0;36mtext\033[0m");
        return preg_replace('/\033\[(?:\d;?)+m/', '', $text);
    }
}
