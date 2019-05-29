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
    public function testShouldCreateNewGameStateWithoutParticipants()
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\Service\ParticipantService $participantService */
        $participantService= self::createMock(\GameMasterTool\Service\ParticipantService::class);
        $gameState = new GameState($participantService);
        self::assertInstanceOf(GameState::class, $gameState);
    }
}
