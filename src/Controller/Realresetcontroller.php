<?php

namespace App\Controller;

use App\utils\database;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Realresetcontroller extends AbstractController
{
    /**
     * @Route("/realreset", name="realreset")
     */
    public function realresetPasword(Request $request, UserRepository $userRepository, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $encoder){
        
        $this->userRepository = $userRepository;
        $this->csrfTokenManager = $csrfTokenManager;
       
        if ($request->isMethod('post')){
            $resettoken= $request->query->get('token');
            $csrftoken= $request->request->get('_csrf_token');
            $plainPassword = $request->request->get('plainPassword');

            // 'authenticate' is the same value used in the template to generate the token
    
            if (!$this->isCsrfTokenValid('authenticate', $csrftoken)) 
            {
                return $this->redirectToRoute('error403');
            }
            // check user exist?
            $user = $userRepository->findOneBy(['reset_token' => $resettoken]);

            $dateExpire = $user->getTokenExpireTime();
            $datetime = new \DateTime();
            $datetime->format('H:i:s \O\n Y-m-d');
            
            if (($user) AND  ($datetime < $dateExpire))
            {
                $test= "test";

                $em = $this->getDoctrine()->getManager();
                $user->setResetToken(null);
                $user->setTokenExpireTime(null);            
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);

                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Jouw paswoord is succesvol gereset, u kan nu inloggen met het nieuw paswoord.');
                    return $this->redirectToRoute('login');      

            }
            else {
                $this->addFlash(
                    'notice',
                    'Je bent niet gemachtigd om het paswoord te resetten');
                    return $this->redirectToRoute('login');      
            }
        } 
        return $this->render('login/realreset.html.twig');
    }
}


