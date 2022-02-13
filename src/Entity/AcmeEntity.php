<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AcmeAssert;

class AcmeEntity
{

    /**
     * @Assert\NotBlank
     * @AcmeAssert\ContainsAlphanumeric
     */
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return AcmeEntity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



}