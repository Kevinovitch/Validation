<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * @Assert\GroupSequenceProvider()
 */
class User implements GroupSequenceProviderInterface
{
    /**
     * @Assert\NotBlank
     */
    private $name;

    /**
     * Assert\CardScheme(
     *      schemes={"VISA"},
     *      groups={"Premium"}
     * )
     */
    private $creditCard;


    public function getGroupSequence(): array
    {
        // when returning a simple array, if there's a violation in any group
        // the rest of groups are not validated. E.g. if 'User' fails,
        // 'Premium" and "Api' are not validated:
        return ['User', 'Premium', 'Api'];

        // when returning a nested array, all the groups included in each array
        // are validated. E.g. if 'User' fails, 'Premium' is also validated
        // (and you'll get its violations too) but 'Api' won't be validated:
        /* return [['User', 'Premium'], 'Api']; */

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param mixed $creditCard
     * @return User
     */
    public function setCreditCard($creditCard): User
    {
        $this->creditCard = $creditCard;
        return $this;
    }


}
