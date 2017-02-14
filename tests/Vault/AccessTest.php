<?php
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Tests;

use Spiral\Security\ActorInterface;
use Spiral\Security\Actors\Guest;
use Spiral\Vault\Bootloaders\InsecureBootloader;

class AccessTest extends HttpTest
{
    public function testVaultWelcomeForbidden()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());

        $response = $this->get('/vault/welcome');
        $this->assertSame(403, $response->getStatusCode());
    }

    public function testVaultWelcomeInsecure()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());
        $this->app->getBootloader()->bootload([
            InsecureBootloader::class
        ]);

        $response = $this->get('/vault/welcome');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Welcome to Vault', (string)$response->getBody());
        $this->assertContains('Links and Routing', (string)$response->getBody());
    }


    public function testVaultWelcomeVisuals()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());
        $this->app->getBootloader()->bootload([
            InsecureBootloader::class
        ]);

        $response = $this->get('/vault/welcome/visuals');
        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @expectedException \Spiral\Core\Exceptions\ControllerException
     * @expectedExceptionMessage Undefined vault controller 'undefined'
     */
    public function testDirect()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());
        $this->app->getBootloader()->bootload([
            InsecureBootloader::class
        ]);

        $this->vault->callAction('undefined');
    }
}