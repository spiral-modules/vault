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

class PermissionsTest extends HttpTest
{
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
            'vault.sample',
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
        $this->assertContains('Sample Controllers', (string)$response->getBody());
        $this->assertContains('Links and Routing', (string)$response->getBody());
    }

    public function testVaultDirectRulesSample()
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
            'vault.sample',
            AllowRule::class
        );

        $this->app->permissions->associate(
            'guest',
            'vault.welcome.routing',
            AllowRule::class
        );

        $response = $this->get('/vault/sample');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Hello, Dave.', (string)$response->getBody());
    }

    public function testVaultPartialAccess()
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
            'vault.sample',
            ForbidRule::class
        );

        $this->app->permissions->associate(
            Guest::ROLE,
            'vault.welcome.routing',
            ForbidRule::class
        );

        $response = $this->get('/vault/welcome');
        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Welcome to Vault', (string)$response->getBody());
        $this->assertNotContains('Sample Controllers', (string)$response->getBody());
        $this->assertNotContains('Links and Routing', (string)$response->getBody());
    }
}