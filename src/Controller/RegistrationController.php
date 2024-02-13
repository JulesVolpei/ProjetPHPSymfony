<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

// Route
class RegistrationController extends AbstractController
{
    // Route
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        // Avoir les infos du formulaires
        $user = new User();
        $plaintextPassword = "password";
        // Set les paramètres du User

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        return $this->render("", []);
    }
}