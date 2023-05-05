<?php declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fitted\Monolog\Handler;

use Fitted\Monolog\Test\TestCase;
use Fitted\Monolog\Logger;

class AbstractHandlerTest extends TestCase
{
    /**
     * @covers Fitted\Monolog\Handler\AbstractHandler::__construct
     * @covers Fitted\Monolog\Handler\AbstractHandler::getLevel
     * @covers Fitted\Monolog\Handler\AbstractHandler::setLevel
     * @covers Fitted\Monolog\Handler\AbstractHandler::getBubble
     * @covers Fitted\Monolog\Handler\AbstractHandler::setBubble
     */
    public function testConstructAndGetSet()
    {
        $handler = $this->getMockForAbstractClass('Fitted\Monolog\Handler\AbstractHandler', [Logger::WARNING, false]);
        $this->assertEquals(Logger::WARNING, $handler->getLevel());
        $this->assertEquals(false, $handler->getBubble());

        $handler->setLevel(Logger::ERROR);
        $handler->setBubble(true);
        $this->assertEquals(Logger::ERROR, $handler->getLevel());
        $this->assertEquals(true, $handler->getBubble());
    }

    /**
     * @covers Fitted\Monolog\Handler\AbstractHandler::handleBatch
     */
    public function testHandleBatch()
    {
        $handler = $this->getMockForAbstractClass('Fitted\Monolog\Handler\AbstractHandler');
        $handler->expects($this->exactly(2))
            ->method('handle');
        $handler->handleBatch([$this->getRecord(), $this->getRecord()]);
    }

    /**
     * @covers Fitted\Monolog\Handler\AbstractHandler::isHandling
     */
    public function testIsHandling()
    {
        $handler = $this->getMockForAbstractClass('Fitted\Monolog\Handler\AbstractHandler', [Logger::WARNING, false]);
        $this->assertTrue($handler->isHandling($this->getRecord()));
        $this->assertFalse($handler->isHandling($this->getRecord(Logger::DEBUG)));
    }

    /**
     * @covers Fitted\Monolog\Handler\AbstractHandler::__construct
     */
    public function testHandlesPsrStyleLevels()
    {
        $handler = $this->getMockForAbstractClass('Fitted\Monolog\Handler\AbstractHandler', ['warning', false]);
        $this->assertFalse($handler->isHandling($this->getRecord(Logger::DEBUG)));
        $handler->setLevel('debug');
        $this->assertTrue($handler->isHandling($this->getRecord(Logger::DEBUG)));
    }
}
