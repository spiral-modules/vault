<?php
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Tests;

class UriTest extends BaseTest
{
    public function testUriToController()
    {
        $this->assertSame(
            '/vault/welcome',
            (string)$this->vault->uri('welcome')
        );
    }

    public function testUriToAction()
    {
        $this->assertSame(
            '/vault/welcome/index',
            (string)$this->vault->uri('welcome:index')
        );
    }

    public function testUriToActionWithQuery()
    {
        $this->assertSame(
            '/vault/welcome/index/10?refresh=true',
            (string)$this->vault->uri('welcome:index', ['id' => 10, 'refresh' => 'true'])
        );
    }

    /**
     * @expectedException \Spiral\Vault\Exceptions\VaultException
     * @expectedExceptionMessage Unable to generate uri, undefined controller 'undefined'
     */
    public function testUriToUndefinedController()
    {
        $this->vault->uri('undefined');
    }
}