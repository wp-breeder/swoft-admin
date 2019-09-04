<?php declare(strict_types=1);


namespace App\Helper;


use function compact;

/**
 * 返回值帮助方法
 * Class ReturnHelper
 * @package App\Helper
 */
class ReturnHelper
{
    /**
     * 格式化返回值
     * @param array ...$argv
     * @return array
     */
    public static function format(...$argv): array
    {
        $count = count($argv);
        if (2 < $count) {
            [$msg, $code, $data] = $argv;
        } else if ($count == 2) {
            [$msg, $code] = $argv;
        } else {
            [$msg] = $argv;
        }
        $data = $data ?? [];
        $code = $code ?? 200;
        return compact('msg', 'code', 'data');
    }

}