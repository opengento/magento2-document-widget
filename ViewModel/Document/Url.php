<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Api\Data\DocumentInterface;
use Opengento\Document\Model\Document\Helper\Url as UrlHelper;

final class Url implements ArgumentInterface
{
    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(
        UrlHelper $urlHelper
    ) {
        $this->urlHelper = $urlHelper;
    }

    public function getFileUrl(DocumentInterface $document): string
    {
        return $this->urlHelper->getFileUrl($document);
    }
}
