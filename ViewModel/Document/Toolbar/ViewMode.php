<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document\Toolbar;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\DocumentWidget\Model\Document\Toolbar\ViewMode as ToolbarViewMode;

final class ViewMode implements ArgumentInterface
{
    public const PARAM_NAME = ToolbarViewMode::PARAM_NAME;

    /**
     * @var ToolbarViewMode
     */
    private $viewMode;

    public function __construct(
        ToolbarViewMode $viewMode
    ) {
        $this->viewMode = $viewMode;
    }

    public function isEnabled(): bool
    {
        return $this->viewMode->isEnabled();
    }

    public function isActive(string $mode): bool
    {
        return $this->viewMode->getMode() === $mode;
    }

    public function getMode(): string
    {
        return $this->viewMode->getMode();
    }

    public function getModes(): array
    {
        return $this->viewMode->getModes();
    }
}
