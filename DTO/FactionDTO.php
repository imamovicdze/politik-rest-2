<?php

class FactionDTO
{
    public $id;
    public $updated;
    public $code;
    public $name;
    public $shortName;

    public function __construct($faction)
    {
        $this->id = $faction->id;
        $this->updated = $faction->updated;
        $this->code = $faction->code;
        $this->name = $faction->name;
        $this->shortName = $faction->shortName;
    }
}
