<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        if ($this->getUser()) {
            return $this->json($this->getUser());
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        // remove previous authenticate token and generate another one
        $csrfTokenManager->removeToken('authenticate');
        $csrfToken = $csrfTokenManager->getToken('authenticate');

        $loginUtils = [
            'csrf_token' => $csrfToken->getValue(),
            'last_username' => $lastUsername,
            'error' => $error
        ];
        
        //return $this->render('security/login.html.twig', $loginUtils);
        return $this->json($loginUtils);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // the user will be logout through this route
    }
}
