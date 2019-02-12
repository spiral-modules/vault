<?php
declare(strict_types=1);
/**
 * vault
 *
 * @author    Wolfy-J
 */

namespace Spiral\Vault\Controllers\Grids;

use Spiral\Core\Component;
use Spiral\Pagination\PaginatorAwareInterface;
use Spiral\Pagination\Traits\PaginatorTrait;

class SampleSource extends Component implements \IteratorAggregate, PaginatorAwareInterface, \Countable
{
    use PaginatorTrait;

    private $data = [
        0 => [
            'id'      => 1,
            'active'  => true,
            'name'    => 'Anton',
            'balance' => 100
        ],
        1 => [
            'id'      => 2,
            'active'  => false,
            'name'    => 'John',
            'balance' => 200
        ],
        2 => [
            'id'      => 3,
            'active'  => false,
            'name'    => 'Bill',
            'balance' => 300
        ],
        3 => [
            'id'      => 4,
            'active'  => false,
            'name'    => 'William',
            'balance' => 400
        ],
        4 => [
            'id'      => 5,
            'active'  => true,
            'name'    => 'Bruce',
            'balance' => 500
        ]
    ];

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        $paginator = $this->getPaginator();

        return new \ArrayIterator(array_slice(
            $this->data,
            $paginator->getOffset(),
            $paginator->getLimit()
        ));
    }
}