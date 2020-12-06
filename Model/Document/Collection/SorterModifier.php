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

    public function __construct(
        Sorter $sorter
    ) {
        $this->sorter = $sorter;
    }

    public function apply(AbstractDb $collection): void
    {
        $collection->setOrder($this->sorter->getOrder(), $this->sorter->getDirection());
    }
}
