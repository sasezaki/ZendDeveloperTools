<?php
/**
 * ZendDeveloperTools
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    ZendDeveloperTools
 * @subpackage Collector
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace ZendDeveloperTools\Collector;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Application;
use ZendDeveloperTools\Exception\SerializableException;

/**
 * Exception Data Collector.
 *
 * @category   Zend
 * @package    ZendDeveloperTools
 * @subpackage Collector
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ExceptionCollector extends CollectorAbstract
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'exception';
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 100;
    }

    /**
     * @inheritdoc
     */
    public function collect(MvcEvent $mvcEvent)
    {
        if ($mvcEvent->getError() === Application::ERROR_EXCEPTION) {
            $this->data = array(
                'exception' => new SerializableException($mvcEvent->getParam('exception'))
            );
        }
    }

    /**
     * Checks if an exception was thrown during the runtime.
     *
     * @return boolean
     */
    public function hasException()
    {
        return isset($this->data['exception']);
    }

    /**
     * Checks if an exception was re-thrown during the runtime.
     *
     * @return boolean
     */
    public function hasPreviousException()
    {
        return (isset($this->data['exception']) && $this->data['exception']->getPrevious() !== null);
    }

    /**
     * Returns the exception.
     *
     * @return SerializableException
     */
    public function getException()
    {
        return $this->data['exception'];
    }

    /**
     * Returns the previous exception.
     *
     * @return SerializableException
     */
    public function getPreviousException()
    {
        return $this->data['exception']->getPrevious();
    }

    /**
     * Returns the exception message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->data['exception']->getMessage();
    }

    /**
     * Returns the previous exception message.
     *
     * @return string
     */
    public function getPreviousMessage()
    {
        return $this->data['exception']->getPrevious()->getMessage();
    }

    /**
     * Returns the file in which the exception occurred.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->data['exception']->getFile();
    }

    /**
     * Returns the file in which the previous exception occurred.
     *
     * @return string
     */
    public function getPreviousFile()
    {
        return $this->data['exception']->getPrevious()->getFile();
    }

    /**
     * Returns the exception code.
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->data['exception']->getCode();
    }

    /**
     * Returns the previous exception code.
     *
     * @return integer
     */
    public function getPreviousCode()
    {
        return $this->data['exception']->getPrevious()->getCode();
    }

    /**
     * Returns the exception trace.
     *
     * @return array
     */
    public function getTrace()
    {
        return $this->data['exception']->getTrace();
    }

    /**
     * Returns the previous exception trace.
     *
     * @return array
     */
    public function getPreviousTrace()
    {
        return $this->data['exception']->getPrevious()->getTrace();
    }
}