<?php
namespace GameMasterTool;

/**
 * This class simply provides methods for enchancing terminal usage.
 */
class Terminal
{
    /**
     * @var int The terminal width cache
     */
    private static $width = null;
    /**
     * Returns the terminal width.
     * @return int
     */
    public static function getWidth()
    {
        if (self::$width !== null) {
            return self::$width;
        }
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $matches = [];
            $output = shell_exec('mode');
            preg_match('/\s*columns\:?\s*(\d+)\s*/i', $output, $matches);
            self::$width = (int) $matches[1];
        } else {
            self::$width = (int) shell_exec('tput cols');;
        }
        return self::$width;
    }
    /**
     * Prints the command prompt on the standard output.
     */
    public static function printCommandPrompt()
    {
        echo '+' . str_repeat('-', self::getWidth() - 2) . '+' . PHP_EOL;
        echo '  What is thy bidding my Game Master?' . PHP_EOL;
        echo '+' . str_repeat('-', self::getWidth() - 2) . '+' . PHP_EOL;
        echo '> ';
    }
    /**
     * Prints the welcome message with the authors' annotation.
     * @param string $authors
     */
    public static function printWelcomeMessage($authors = '')
    {
        echo '+' . str_repeat('-', self::getWidth() - 2) . '+' . PHP_EOL;
        echo str_pad(' ___ ___    _   __  __    ___                  __  __         _             _____         _', self::getWidth(), ' ', STR_PAD_BOTH) . PHP_EOL;
        echo str_pad('/ __| _ \\  /_\\ |  \\/  |  / __|__ _ _ __  ___  |  \\/  |__ _ __| |_ ___ _ _  |_   _|__  ___| |', self::getWidth(), ' ', STR_PAD_BOTH) . PHP_EOL;
        echo str_pad('| (__|   / / _ \\| |\\/| | | (_ / _` | \'  \\/ -_) | |\\/| / _` (_-<  _/ -_) \'_|   | |/ _ \\/ _ \\ |', self::getWidth(), ' ', STR_PAD_BOTH) . PHP_EOL;
        echo str_pad('\\___|_|_\\/_/ \\_\\_|  |_|  \\___\\__,_|_|_|_\\___| |_|  |_\\__,_/__/\\__\\___|_|     |_|\\___/\\___/_|', self::getWidth(), ' ', STR_PAD_BOTH) . PHP_EOL . PHP_EOL;
        echo '+' . str_repeat('-', self::getWidth() - 2) . '+' . PHP_EOL;
        echo str_pad('Created by: ' . $authors, self::getWidth(), ' ', STR_PAD_BOTH) . PHP_EOL;
    }
}
