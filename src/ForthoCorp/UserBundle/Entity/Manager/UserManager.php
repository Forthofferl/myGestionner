<?php

namespace FLOT\UserBundle\Entity\Manager;

use FLOT\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use Doctrine\ORM\EntityManager;

class UserManager
{

    private $em, $container;

    function __construct(EntityManager $em, ContainerInterface $container, BaseUserManager $um)
    {
        $this->em           = $em;
        $this->container    = $container;
        $this->um    = $um;
    }

    /**
     * Edit intervenant user
     */
    public function updateIntervenantUser(User $user){

        foreach($user->getRoles() as $userRole)
            $user->removeRole($userRole);

        $user->addRole($this->getRole($user->getJob()));
        $user->setUpdatedAt(new \DateTime());

        $this->container->get('fos_user.user_manager')->updateUser($user);

        return $user;
    }

    /**
     * Delete intervenant user
     */
    public function deleteIntervenantUser(User $user, User $deleter){

        $user->setDeletedAt(new \DateTime());
        $user->setDeletedBy($deleter);
        $user->setEnabled(false);
        $this->container->get('fos_user.user_manager')->updateUser($user);

        return $user;
    }


    /**
     *  Add User From Intervenant Form
     */
    public function createIntervenantUser(User $user){

        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $username = $this->generateUsername();
            $user->setUsername($username);
            $user->setEmail($username . '@nomail.com');
        } else {
            $user->setUsername($user->getEmail());

        }

        $user->setPlainPassword($this->generatePassword());
        $user->setApiKey($this->generateApiKey());
        $user->setEnabled(1);

        $user->addRole($this->getRole($user->getJob()));

        $this->um->updateUser($user, true);

        return $user;

    }


    /**
     * Generate unique username
     * @return string
     */
    public function generateUsername()
    {
        $username = strtolower($this->generatePassword().$this->generatePassword());

        while($this->em->getRepository('FLOTUserBundle:User')->findOneByUsername($username))
            $username = strtolower($this->generatePassword().$this->generatePassword().'@nomail.com');

        return $username;
    }

    /**
     * Generate a default password
     *
     * @param string $password
     *
     * @return string
     */
    protected function generatePassword($password = null)
    {
        $string = "abcdefghjkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
        for($i = 0; $i <= 6; $i++) {
            $password .= $string[mt_rand(0, (strlen($string)-1))];
        }
        return $password;
    }

    /**
     * Generate a default API KEY
     *
     * @return string
     */
    protected function generateApiKey()
    {
        $string = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
        $password = null;
        for($i = 0; $i <= 9; $i++) {
            $password .= $string[mt_rand(0, (strlen($string)-1))];
        }
        return $password;
    }

    public function toArray(User $user){

        return array(
            'id'            => $user->getId(),
            'firstname'     => $user->getFistname(),
            'lastname'      => $user->getLastname(),
            'birthdate'     => $user->getBirthdate(),
            'country'       => $user->getCountry(),
            'job'           => $user->getJob(),
            'company'       => $user->getCompany(),
            'maritalStatus' => $user->getMaritalStatus(),
            'civility'      => $user->getCivility(),
            'phone'         => $user->getPhone(),
            'mobile'        => $user->getMobile(),
            'address'       => $this->container->get('flot.address_manager')->toArray($user->getAdress()),
            'address2'      => $this->container->get('flot.address_manager')->toArray($user->getAdress2()),
            'avatar'        => ($user->getUser())?$this->container->get('flot.image_manager')->toArray($user->getAvatar()):false,
            'created_at'    => ($user->getCreatedAt())?$user->getCreatedAt()->format('Y-m-d H:i:s'):false,
            'updated_at'    => ($user->getUpdatedAt())?$user->getUpdatedAt()->format('Y-m-d H:i:s'):false,
            'deleted_at'    => ($user->getDeletedAt())?$user->getDeletedAt()->format('Y-m-d H:i:s'):false
        );

    }

    private function getRole($job){

        if($job == 'Clerc')         return 'ROLE_CLERC';
        if($job == 'Notaire')       return 'ROLE_NOTARY';
        if($job == 'Partenaire')    return 'ROLE_PARTNER';
        if($job == 'Consultant')    return 'ROLE_CONSULTANT';

        return false;
    }

}