<?php

namespace Pim\Bundle\UIBundle\Entity;

/**
 * Notification event entity
 *
 * @author    Willy Mesnage <willy.mesnage@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class NotificationEvent
{
    /** @var integer */
    protected $id;

    /** @var string */
    protected $route;

    /** @var array */
    protected $routeParams = [];

    /** @var string */
    protected $message;

    /** @var array */
    protected $messageParams = [];

    /** @var \DateTime */
    protected $created;

    /** @var string */
    protected $type;

    /** @var array */
    protected $context = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return NotificationEvent
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set routeParams
     *
     * @param array $routeParams
     *
     * @return NotificationEvent
     */
    public function setRouteParams(array $routeParams)
    {
        $this->routeParams = $routeParams;

        return $this;
    }

    /**
     * Get routeParams
     *
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return NotificationEvent
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set messageParams
     *
     * @param array $messageParams
     *
     * @return NotificationEvent
     */
    public function setMessageParams(array $messageParams)
    {
        $this->messageParams = $messageParams;

        return $this;
    }

    /**
     * Get messageParams
     *
     * @return array
     */
    public function getMessageParams()
    {
        return $this->messageParams;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return NotificationEvent
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set context
     *
     * @param array $context
     *
     * @return NotificationEvent
     */
    public function setContext(array $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }
}
