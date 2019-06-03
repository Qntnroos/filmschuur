<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


class NewUserController extends AbstractController
{
    /**
     * @Route("/newuser", name="newuser")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {  
            $data = $form->getData();
            $user = new User();
            $user->setUserFirstname($data['user_firstname']);
            $user->setUserLastname($data['user_lastname']);
            $user->setEmail($data['email']);
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));
            $user->setUserAdress($data['user_adress']);
            $user->setPhone($data['phone']);
            $user->setGenderID($data['gender_id']);
            $user->setBirthday($data['birthday']);
            $user->setAuthor($this->getUser());
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Je bent succesvol geregistreerd');
            return $this->redirectToRoute('login');
        }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );
       

        return $this->render('login/newuser.html.twig', [
            'userRegistrationForm' => $form->createView()
        ]);
    }
}
