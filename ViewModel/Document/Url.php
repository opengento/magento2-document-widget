<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Api\Data\DocumentInterface;
use Opengento\Document\Model\Document\Filesystem\UrlResolverInterface;

final class Url implements ArgumentInterface
{
    /**
     * @var UrlResolverInterface
     */
    private $urlResolver;

    public function __construct(
        UrlResolverInterface $urlResolver
    ) {
        $this->urlResolver = $urlResolver;
    }

    public function getFileUrl(DocumentInterface $document): string
    {
        return $this->urlResolver->getFileUrl($document);
    }
}
