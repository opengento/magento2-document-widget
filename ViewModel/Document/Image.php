<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel\Document;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Api\Data\DocumentInterface;
use Opengento\Document\Model\Document\Helper\ImageBuilder;
use Opengento\Document\Model\File\Image as ImageData;

final class Image implements ArgumentInterface
{
    /**
     * @var ImageBuilder
     */
    private $imageBuilder;

    public function __construct(
        ImageBuilder $imageBuilder
    ) {
        $this->imageBuilder = $imageBuilder;
    }

    public function getImage(DocumentInterface $document, string $imageId): ImageData
    {
        return $this->imageBuilder->setDocument($document)->setImageId($imageId)->create();
    }
}
