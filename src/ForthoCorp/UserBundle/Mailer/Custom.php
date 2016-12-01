<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FLOT\UserBundle\Mailer;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;

/**
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class Custom implements MailerInterface
{
    protected $mailer;
    protected $router;
    protected $templating;
    protected $parameters;

    public function __construct($mailer, UrlGeneratorInterface  $router, EngineInterface $templating, array $parameters)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->templating = $templating;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['confirmation.template'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' =>  $url
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['confirmation'], $user->getEmail());
    }

    /**
     * {@inheritdoc}
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
	$url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        if($this->isValidMail($user->getEmail())){
            $message = \Swift_Message::newInstance()
                ->setSubject('GroupeFlot | Réinitialisation de mot de passe.')
                ->setFrom(array("no-reply@groupeflot.fr" => "Groupe Flot"))
                ->setTo($user->getEmail())
                ->setBody($this->templating->render('FLOTUserBundle:Resetting:email.html.twig', array(
                    'user' => $user,
                    'confirmationUrl' =>  $url
                )), 'text/html');

            $this->mailer->send($message);
        }
    }

    /**
     * @param string $renderedTemplate
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendEmailMessage($renderedTemplate, $fromEmail, $toEmail)
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));
        if($this->isValidMail($toEmail)){
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($fromEmail)
                ->setTo($toEmail)
                ->setBody($body);

            $this->mailer->send($message);
        }
    }

    private function isValidMail($email){
        $email = explode('@', $email);
        if($email[1] == 'no-email.com'){
            return false;
        }
        return true;
    }
}

