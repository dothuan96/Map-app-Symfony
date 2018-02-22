<?php
// src/Entity/Task.php
namespace App\Entity;

class TaskPhase2
{
    protected $address1;
    protected $address2;
    protected $mode;

    public function getLocation1()
    {
        return $this->address1;
    }

    public function setLocation1($address1)
    {
        $this->address1 = $address1;
    }

    public function getLocation2()
    {
        return $this->address2;
    }

    public function setLocation2($address2)
    {
        $this->address2 = $address2;
    }

    public function getTravel()
    {
        return $this->mode;
    }

    public function setTravel($mode = null)
    {
        $this->mode = $mode;
    }
}
?>
