<?php
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Tests;

use Spiral\Security\ActorInterface;
use Spiral\Security\Actors\Guest;
use Spiral\Security\Rules\AllowRule;
use Spiral\Security\Rules\ForbidRule;
use Spiral\Vault\Bootloaders\InsecureBootloader;

class WelcomeTest extends HttpTest
{
    public function testVaultWelcomeForbidden()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());

        $response = $this->get('/vault/welcome');
        $this->assertSame(403, $response->getStatusCode());
    }

    public function testVaultDirectRules()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());
        $this->app->permissions->addRole('guest');

        $this->app->permissions->associate(
            'guest',
            'vault.welcome',
            AllowRule::class
        );

        $this->app->permissions->associate(
            'guest',
            'vault.welcome.routing',
            AllowRule::class
        );

        $response = $this->get('/vault/welcome');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Welcome to Vault', (string)$response->getBody());
        $this->assertContains('Links and Routing', (string)$response->getBody());
    }

    public function testVaultDirectRulesNoRouting()
    {
        $this->app->container->bind(ActorInterface::class, new Guest());
        $this->app->permissions->addRole('guest');

        $this->app->permissions->associate(
            Guest::ROLE,
            'vault.welcome',
            AllowRule::class
        );

        $this->app->permissions->associate(
            Guest::ROLE,
            'vault.welcome.routing',
            ForbidRule::class
        );

        $response = $this->get('/vault/welcome');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Welcome to Vault', (string)$response->getBody());
        $this->assertNotContains('Links and Routing', (string)$response->getBody());
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
}