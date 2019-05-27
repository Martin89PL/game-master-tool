<?php

use GameMasterTool\GameState;

class GameStateTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testShouldReturnInputByGameState()
    {
        $gameState = new GameState();
        $result = $gameState->run('some command');

        self::assertEquals('some command', $result);
    }
}