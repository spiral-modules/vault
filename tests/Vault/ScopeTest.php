<?php
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Tests;

use Spiral\Vault\Vault;

class ScopeTest extends BaseTest
{
    public function testScope()
    {
        $this->assertInstanceOf(Vault::class, vault());
    }
}