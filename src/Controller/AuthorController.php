<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthorController extends AbstractController
{
    /**
     * @Route("validation/author", name="app_validation_author")
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function validationAuthor(ValidatorInterface $validator)
    {
        $author = new Author();

        $author->setName('Messi');

        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList Object. This gives us a nice string
             * for debugging
             */
//            $errorstring = (string) $errors;
//
//            return new Response($errorstring);

            /*
             * or do this
             */
            return $this->render('author/validation.html.twig', [
                'errors' => $errors,
            ]);
        }

        return new Response('The author is valid! Yes!');
    }

    /**
     * @Route("validation/author/example", name="app_validation_author_example")
     * @return Response
     */
    public function exampleAuthorForm()
    {
        $exampleAuthorForm = $this->createFormBuilder()
            ->add('myField', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min => 3'])],
            ])
            ->getForm();
        ;

        return $this->render('author/example_author_form.html.twig', [
            'form' => $exampleAuthorForm->createView()
        ]);
    }

    /**
     * @Route("/validation/user", name="app_validation_user")
     */
    public function validationUser(Request $request, ValidatorInterface $validator): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

       // $errors = $validator->validate($user);
        if($form->isSubmitted() && $form->isValid())
        {
            return new Response('The user is valid! Yes!');
        }

        return $this->render('user/validation.html.twig', [
            'form' => $form->createView(),
            //'errors' => $errors,
        ]);
    }
}