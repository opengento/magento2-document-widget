<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\Model\Document\Toolbar;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Opengento\DocumentWidget\Model\Document\Session;

final class Sorter
{
    public const ORDER_PARAM_NAME = 'sort';
    public const DIRECTION_PARAM_NAME = 'order';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var string[]
     */
    private $orders;

    /**
     * @var string|null
     */
    private $order;

    /**
     * @var string|null
     */
    private $direction;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Session $session,
        RequestInterface $request,
        array $orders = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->session = $session;
        $this->request = $request;
        $this->orders = $orders;
    }

    public function getOrder(): string
    {
        if (!$this->order) {
            $this->order = $this->request->getParam(
                self::ORDER_PARAM_NAME,
                $this->session->getData(self::ORDER_PARAM_NAME)
            ) ?? $this->resolveDefaultOrder();
            $this->session->setData(self::ORDER_PARAM_NAME, $this->order);
        }

        return $this->order;
    }

    public function getDirection(): string
    {
        if (!$this->direction) {
            $this->direction = $this->request->getParam(
                self::DIRECTION_PARAM_NAME,
                $this->session->getData(self::DIRECTION_PARAM_NAME)
            ) ?? $this->resolveDefaultDirection();
            $this->session->setData(self::DIRECTION_PARAM_NAME, $this->direction);
        }

        return $this->direction;
    }

    public function getAvailableOrders(): array
    {
        return $this->orders;
    }

    private function resolveDefaultOrder(): string
    {
        return (string) $this->scopeConfig->getValue('opengento_document/list/defaultorder');
    }

    private function resolveDefaultDirection(): string
    {
        return (string) $this->scopeConfig->getValue('opengento_document/list/defaultdirection');
    }
}
