<?php
namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
        /* Our job in getUser() is to use these $credentials to return a User object,
        or null if the user isn't found. Because we're storing our users in the database,
        we need to query for the user via their email. And to do that, 
        we need the UserRepository that was generated with our entity. */

    private $userRepository;
    private $router;
    private $csrfTokenManager;
    private $passwordEncoder;


    public function __construct(UserRepository $userRepository, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManager,  UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        // do your work when we're POSTing to the login page

        /* The first method - supports() - is called on every request.
         Our job is simple: to return true if this request contains 
         authentication info that this authenticator knows how to process.
         And if not, to return false. In this case, when we submit the login form,
         it POSTs to /login. So, our authenticator should only try to authenticate
         the user in that exact situation. Return $request->attributes->get('_route') === 'app_login':*/

        /* if we return false from supports(), nothing else happens.
         Symfony doesn't call any other methods on our authenticator,
         and the request continues on like normal to our controller,
         like nothing happened. It's not an authentication failure - 
         it's just that nothing happens at all. */

        return $request->attributes->get('_route') === 'login'
            && $request->isMethod('POST');
    }
    public function getCredentials(Request $request)
    {
        /*I'm just inventing these email and password keys for the new array:
         we can really return whatever we want from this method. Because, 
         after we return from getCredentials(), Symfony will immediately call getUser()
         and pass this array back to us as the first $credentials argument:*/
         
        $credentials = [
            'email' => $request->request->get('loginFormEmail'),
            'password' => $request->request->get('loginFormPassword'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        
        return $credentials;
    
    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        // todo (query by email)
        return $this->userRepository->findOneBy(['email' => $credentials['email']]);
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
        /* If you did return false, authentication would fail and the user would see an
         "Invalid Credentials" message. We'll see that soon.But, when you return true... 
         authentication is successful! To figure out what to do, now that the user is authenticated,
         Symfony calls onAuthenticationSuccess():
        // only needed if we need to check a password - we'll do that later! */
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        /* If our authenticator is able to return a User from getUser() and we return true from checkCredentials():
        Our user is logged in!
        Redirect user via SecurityController*/ 
        
        return new RedirectResponse($this->router->generate('homepage'));
    }
    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
}