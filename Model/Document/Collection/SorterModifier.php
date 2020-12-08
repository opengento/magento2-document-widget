<?php
/**
 * Copyright Â© MP Biomedicals, LLC. All rights reserved.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\Model\Document\Collection;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Data\CollectionModifierInterface;
use Opengento\DocumentWidget\Model\Document\Toolbar\Sorter;

/**
 * @api
 */
final class SorterModifier implements CollectionModifierInterface
{
    /**
     * @var Sorter
     */
    private $sorter;

    /**
     * @var string[]
     */
    private $mapper;

    public function __construct(
        Sorter $sorter,
        array $mapper = []
    ) {
        $this->sorter = $sorter;
        $this->mapper = $mapper;
    }

    public function apply(AbstractDb $collection): void
    {
        $field = $this->sorter->getOrder();
        if (isset($this->mapper[$field])) {
            $collection->addFilterToMap($field, $this->mapper[$field]);
        }

        $collection->setOrder($field, $this->sorter->getDirection());
    }
}
