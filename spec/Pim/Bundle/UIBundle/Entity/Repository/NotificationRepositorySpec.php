<?php

namespace spec\Pim\Bundle\UIBundle\Entity\Repository;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class NotificationRepositorySpec extends ObjectBehavior
{
    function let(EntityManager $em, ClassMetadata $class)
    {
        $class->name = 'Pim\Bundle\UIBundle\Entity\Notification';
        $this->beConstructedWith($em, $class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Pim\Bundle\UIBundle\Entity\Repository\NotificationRepository');
    }

    function it_is_an_entity_repository()
    {
        $this->shouldHaveType('Doctrine\ORM\EntityRepository');
    }
}
