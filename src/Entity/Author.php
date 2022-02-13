<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @Assert\Callback(methods={"loadValidatorMetadata"})
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     * @ORM\Column(type="string")
     */
    private $name;

   /**
     * @Assert\NotBlank()
     */
    //private $password;

    /**
     * @Assert\Choice({"fiction", "non-fiction"})
     * @ORM\Column(type="string", length=255)
     */
    //private $genre;

    /**
     * @Assert\IsTrue(message="The password cannot match your first name")
     */
   /* public function isPasswordSafe()
    {
        return $this->name !== $this->password;
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

   /* public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    } */

    // A commenter

    /**
     * @Assert\Callback()
     */
    /*public function validate(ExecutionContextInterface $context, $payload)
    {
        // somehow you have an array of "fake names"
        $fakeNames = ['Superblabla', 'Kezman', 'Choupo-Moting'];

        // check if the name is actually a fake name
        if (in_array($this->getName(), $fakeNames))
        {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('firstName')
                ->addViolation();
        }

    }*/

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $callback = function (Author $author, ExecutionContextInterface $context, $payload){

            // somehow you have an array of "fake names"
            $fakeNames = ['Lukaku', 'Moussa Sissoko'];

            // check if the name is actually a fake name
            if(in_array($author->getName(), $fakeNames))
            {
                $context->buildViolation('This name sounds totally fake!')
                    ->atPath('name')
                    ->addViolation();
            }
        };

        $metadata->addConstraint(new Assert\Callback($callback));
    }
}
