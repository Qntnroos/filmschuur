<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\RouterInterface;
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
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Validator\Constraints\DateTime;


class ResetPaswordController extends AbstractController
{

    /**
     * @Route("/resetpassword", name="resetpassword")
     */

    public function resetpasswordmail(Request $request, \Swift_Mailer $mailer, UserRepository $userRepository, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $this->userRepository = $userRepository;
        $this->csrfTokenManager = $csrfTokenManager;
        
        if ($request->isMethod('post')){
            $email= $request->request->get('ResetFormEmail');
           
            $token= $request->request->get('_csrf_token');
            // 'authenticate' is the same value used in the template to generate the token
    
            if (!$this->isCsrfTokenValid('authenticate', $token)) 
            {
                return $this->redirectToRoute('error403');
            }
            // check user exist?
            $user = $userRepository->findOneBy(['email' => $email]);

            if ($user)
            {
                $resettoken = $this->generateResetToken();
                $expire_date = $this->expireDate();
                
                $em = $this->getDoctrine()->getManager();
                $user->setResetToken($resettoken);
                $user->setTokenExpireTime($expire_date);         
                $em->persist($user);
                $em->flush();

                $send =[];

                $token = $user->getResetToken();

                // Create the Transport
                $transport = (new \Swift_SmtpTransport('relay.proximus.be', 25))
                ->setUsername('danny.eeraerts@proximus.be')
                ->setPassword('8734DANNY')
                ;
                $mailer = new \Swift_Mailer($transport);
                $message = (new \Swift_Message('Reset jouw DFS-paswoord'))
                ->setFrom($email)
                ->setTo('danny.eeraerts@proximus.be')
                ->setBody( $this->renderView(
                        'login/resetmail.html.twig',array('token'=> $token)
                    ),
                    'text/html'
                );
                $mailer->send($message);
            
                $this->addFlash(
                    'notice',
                    'Raadpleeg je mail. Er is een e-mail met instructies voor het herstellen van
                    je wachtwoord naar je e-mailadres gestuurd.'); 
                }
            else {
                $this->addFlash(
                    'notice',
                    'Dit e-mailadres komt niet voor in ons systeem. Maak een nieuwe account');
                    return $this->redirectToRoute('resetpassword');      
            }
 
            return $this->redirectToRoute('login');     

            /* return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            ); */
        }

        return $this->render('login/resetpassword.html.twig');
        

        /* return $this->render('login/edit.html.twig', [
            'userRegistrationForm' => $form->createView(),
        ]); */


    }
    public function generateResetToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
    public function expireDate()
    {
        $datetime = new \DateTime();
        $datetime->format('H:i:s \O\n Y-m-d');
        $datetime->modify('+3 hours');
        return ($datetime);
    }
}

