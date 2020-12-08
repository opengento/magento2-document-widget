<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\Block\Widget\Document;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Html\Link as HtmlLink;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Opengento\Document\Api\Data\DocumentInterface;
use Opengento\Document\Api\DocumentRepositoryInterface;
use Opengento\DocumentWidget\ViewModel\Document\Image as ImageViewModel;
use Opengento\DocumentWidget\ViewModel\Document\Url as UrlViewModel;

class Link extends HtmlLink implements BlockInterface, IdentityInterface
{
    /**
     * @var DocumentRepositoryInterface
     */
    private $documentRepository;

    /**
     * @var UrlViewModel
     */
    private $urlViewModel;

    /**
     * @var ImageViewModel
     */
    private $imageViewModel;

    public function __construct(
        Context $context,
        DocumentRepositoryInterface $documentRepository,
        UrlViewModel $urlViewModel,
        ImageViewModel $imageViewModel,
        array $data = []
    ) {
        $this->documentRepository = $documentRepository;
        $this->urlViewModel = $urlViewModel;
        $this->imageViewModel = $imageViewModel;
        parent::__construct($context, $data);
    }

    public function getIdentities(): array
    {
        return $this->resolveDocument() instanceof IdentityInterface ? $this->resolveDocument()->getIdentities() : [];
    }

    protected function _beforeToHtml(): self
    {
        $document = $this->resolveDocument();

        if ($document && !$this->hasData('label')) {
            $this->setData('label', $document->getName());
        }
        if ($document && !$this->hasData('path')) {
            $this->setData('path', $this->urlViewModel->getFileUrl($document));
        }
        if ($document && !$this->hasData('title')) {
            $this->setData('title', $document->getName());
        }
        if (!$this->hasData('target')) {
            $this->setData('target', '_blank');
            $this->setData('rel', 'noopener noreferrer');
        }
        if (!$this->hasData('imageHelper')) {
            $this->setData('imageHelper', $this->imageViewModel);
        }
        if (!$this->getChildBlock('imageRenderer')) {
            $this->addChild(
                'imageRenderer',
                Template::class,
                ['template' => 'Opengento_DocumentWidget::document/image.phtml']
            );
        }

        return parent::_beforeToHtml();
    }

    protected function _toHtml(): string
    {
        return $this->resolveDocument() ? parent::_toHtml() : '';
    }

    private function resolveDocument(): ?DocumentInterface
    {
        if (!$this->hasData('document')) {
            try {
                $this->setData('document', $this->documentRepository->getById((int) $this->getData('document_id')));
            } catch (NoSuchEntityException $e) {
                $this->_logger->error($e->getLogMessage(), $e->getTrace());
                $this->setData('document');
            }
        }

        return $this->_getData('document');
    }
}
