<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Api\Data\DocumentInterface;
use Opengento\Document\Model\Document\Filesystem\Url as UrlBuilder;

final class Url implements ArgumentInterface
{
    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    public function __construct(
        UrlBuilder $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getFileUrl(DocumentInterface $document): string
    {
        return $this->urlBuilder->getFileUrl($document);
    }
}
