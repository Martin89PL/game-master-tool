<?php
require_once __DIR__ . '/../vendor/autoload.php';

$input = '';
GameMasterTool\Terminal::printWelcomeMessage('Put your names here');
while ($input !== 'exit') {
    GameMasterTool\Terminal::printCommandPrompt();
    $input = rtrim(fgets(STDIN));
    /* Process the input here... */
}
