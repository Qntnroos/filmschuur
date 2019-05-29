<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewUserController extends AbstractController
{
    /**
     * @Route("/newuser", name="newuser")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(UserRegistrationFormType::class);

        /* $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new User();
            $user->setTitle($data['title']);
            $user->setContent($data['content']);
            $user->setAuthor($this->getUser());
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Je bent succesvol geregistreerd');
            return $this->redirectToRoute('login');
        } */

        return $this->render('login/newuser.html.twig', [
            'userRegistrationForm' => $form->createView()
        ]);
    }
}
