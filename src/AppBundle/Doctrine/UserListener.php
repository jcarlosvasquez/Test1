<?php
/**
 * Created by PhpStorm.
 * User: devteam
 * Date: 6/21/16
 * Time: 6:53 PM
 */

namespace AppBundle\Doctrine;

use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class UserListener
{
    /**
     * @var EncoderFactory
     */
    private $encoderFactory;

    /**
     * UserListener constructor.
     * @param EncoderFactory $encoderFactory
     */
    public function __construct(EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof User) {
            $this->handleEvent($entity);
        }
    }

    private function handleEvent(User $user)
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        $plainPassword = $user->getPlainPassword();
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
    }

}