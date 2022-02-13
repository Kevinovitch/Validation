<?php

namespace App;

use App\Entity\Author;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Validator
{

   /* public static function validate(Author $author, ExecutionContextInterface $context, $payload)
    {
        // somehow you have an array of "fake names"
        $fakeNames = ['Messi', 'Kezman', 'Choupo-Moting'];

        // check if the name is actually a fake name
        if (in_array($author->getName(), $fakeNames))
        {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('firstName')
                ->addViolation();
        }
    }*/
}