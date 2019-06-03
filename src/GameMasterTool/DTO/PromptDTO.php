<?php

namespace GameMasterTool\DTO;

class PromptDTO extends \ArrayObject
{
    public function __construct(string $prompt)
    {
        parent::__construct(explode(' ', $prompt));
    }

    public function getIndexByValue(string $value)
    {
        $iterator = $this->getIterator();

        while ($iterator->valid()) {
            if ($iterator->current() === $value) {
                return $iterator->key();
            }
            $iterator->next();
        }
        return null;
    }
}
