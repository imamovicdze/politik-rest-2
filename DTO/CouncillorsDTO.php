<?php


class CouncillorsDTO
{
    public $id;
    public $updated;
    public $active;
    public $code;
    public $firstName;
    public $lastName;
    public $officialDenomination;

    public function __construct($councillor)
    {
        $this->id = $councillor->id;
        $this->updated = $councillor->updated;
        $this->active = $councillor->active;
        $this->code = $councillor->code;
        $this->firstName = $councillor->firstName;
        $this->lastName = $councillor->lastName;
        $this->officialDenomination = $councillor->officialDenomination;
    }
}
