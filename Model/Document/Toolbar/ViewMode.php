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
use function count;

final class ViewMode
{
    public const PARAM_NAME = 'view';

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
    private $viewModes;

    /**
     * @var string|null
     */
    private $mode;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Session $session,
        RequestInterface $request,
        array $viewModes = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->session = $session;
        $this->request = $request;
        $this->viewModes = $viewModes;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag('opengento_document/list/viewmode') && count($this->getModes()) > 1;
    }

    public function getMode(): string
    {
        if (!$this->mode) {
            $this->mode = $this->request->getParam(self::PARAM_NAME, $this->session->getData(self::PARAM_NAME))
                ?? $this->resolveDefaultMode();
            $this->session->setData(self::PARAM_NAME, $this->mode);
        }

        return $this->mode;
    }

    public function getModes(): array
    {
        return $this->viewModes;
    }

    private function resolveDefaultMode(): string
    {
        return (string) $this->scopeConfig->getValue('opengento_document/list/defaultviewmode');
    }
}
