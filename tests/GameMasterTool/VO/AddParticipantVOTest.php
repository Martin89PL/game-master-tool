<?php

namespace GameMasterTool\VO;

use Codeception\Test\Unit;
use GameMasterTool\DTO\PromptDTO;
use GameMasterTool\VO\AddParticipant;

class AddParticipantVOTest extends Unit
{
    public function testShouldCreateAddParticipantVO()
    {
        $participantAddVO = new AddParticipant(new PromptDTO('add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics'));
        self::assertEquals(1, $participantAddVO->PHY);
        self::assertEquals(2, $participantAddVO->MEN);
        self::assertEquals(1, $participantAddVO->VIT);
        self::assertEquals(15, $participantAddVO->LUC);
    }
}
