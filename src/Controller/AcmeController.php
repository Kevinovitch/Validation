<?php

namespace App\Controller;

use App\Entity\AcmeEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AcmeController extends AbstractController
{
    /**
     * @Route("validation/acme/new", "app_acme_create")
     */
    public function newAction(ValidatorInterface $validator)
    {
        $acmeEntity = new AcmeEntity();

        $acmeEntity->setName('*/');

        $errors = $validator->validate($acmeEntity);

        if (count($errors) > 0) {

            return $this->render('acme/new.html.twig', [
                'errors' => $errors,
            ]);
        }

        return new Response('The author is valid! Yes!');
    }
}