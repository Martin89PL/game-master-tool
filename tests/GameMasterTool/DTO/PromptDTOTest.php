<?php

use GameMasterTool\DTO\PromptDTO;

class PromptDTOTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCreateDtoFromAddParticipantCommand()
    {
        // add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics - <!! name from 2 words!
        $prompt = new PromptDTO('add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics');
        self::assertCount(13, $prompt);
    }

    public function testShouldReturnIndexByValue()
    {
        $prompt = new PromptDTO('add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics');
        self::assertEquals(4, $prompt->getIndexByValue('PHY'));
        self::assertEquals(6, $prompt->getIndexByValue('MEN'));
        self::assertEquals(8, $prompt->getIndexByValue('VIT'));
        self::assertEquals(10, $prompt->getIndexByValue('LUC'));
    }
}