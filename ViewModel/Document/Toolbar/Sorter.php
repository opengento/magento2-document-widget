<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document\Toolbar;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\DocumentWidget\Model\Document\Toolbar\Sorter as ToolbarSorter;

final class Sorter implements ArgumentInterface
{
    public const ORDER_PARAM_NAME = ToolbarSorter::ORDER_PARAM_NAME;
    public const DIRECTION_PARAM_NAME = ToolbarSorter::DIRECTION_PARAM_NAME;

    /**
     * @var ToolbarSorter
     */
    private $sorter;

    public function __construct(
        ToolbarSorter $sorter
    ) {
        $this->sorter = $sorter;
    }

    public function isActive(string $order): bool
    {
        return $this->sorter->getOrder() === $order;
    }

    public function getOrder(): string
    {
        return $this->sorter->getOrder();
    }

    public function getDirection(): string
    {
        return $this->sorter->getDirection();
    }

    public function getAvailableOrders(): array
    {
        return $this->sorter->getAvailableOrders();
    }
}
