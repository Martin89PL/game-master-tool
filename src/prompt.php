<?php
require_once __DIR__ . '/../vendor/autoload.php';

$input = '';
$gameState = new GameState();
GameMasterTool\Terminal::printWelcomeMessage('Put your names here');
while ($input !== 'exit') {
    GameMasterTool\Terminal::printCommandPrompt();
    $input = rtrim(fgets(STDIN));
    $result = $gameState->run($input);
    echo $result;
}
