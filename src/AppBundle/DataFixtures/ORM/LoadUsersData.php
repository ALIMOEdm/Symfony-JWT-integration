<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\UserBundleServices;
use UserBundle\Util\UserManipulator;

class LoadUsersData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /** @var UserManipulator $userManipulator */
        $userManipulator = $this->container->get(UserBundleServices::USER_MANIPULATOR);
        $userManipulator->createUser('test@sibers.com', 11111, 1, 'ROLE_CLIENT');

        /** @var UserManipulator $userManipulator */
        $userManipulator = $this->container->get(UserBundleServices::USER_MANIPULATOR);
        $userManipulator->createUser('test2@sibers.com', 11111, 1, 'ROLE_CLIENT');
    }

    public function getOrder()
    {
        return 1;
    }
}