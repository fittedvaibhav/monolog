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

/**
 * @covers Fitted\Monolog\Handler\NullHandler::handle
 */
class NullHandlerTest extends TestCase
{
    public function testHandle()
    {
        $handler = new NullHandler();
        $this->assertTrue($handler->handle($this->getRecord()));
    }

    public function testHandleLowerLevelRecord()
    {
        $handler = new NullHandler(Logger::WARNING);
        $this->assertFalse($handler->handle($this->getRecord(Logger::DEBUG)));
    }
}
