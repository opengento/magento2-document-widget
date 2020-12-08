<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\Block\Widget\Document;

use Magento\Framework\Data\CollectionModifierInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;
use Magento\Widget\Block\BlockInterface;
use Opengento\Document\Api\Data\DocumentTypeInterface;
use Opengento\Document\Api\DocumentTypeRepositoryInterface;
use Opengento\Document\Model\ResourceModel\Document\Collection;
use Opengento\Document\Model\ResourceModel\Document\CollectionFactory;
use Opengento\DocumentWidget\ViewModel\Document\Image as ImageViewModel;
use Opengento\DocumentWidget\ViewModel\Document\Url as UrlViewModel;

class ListByType extends Template implements BlockInterface, IdentityInterface
{
    /**
     * @var DocumentTypeRepositoryInterface
     */
    private $docTypeRepository;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var UrlViewModel
     */
    private $urlViewModel;

    /**
     * @var ImageViewModel
     */
    private $imageViewModel;

    /**
     * @var CollectionModifierInterface
     */
    private $collectionModifier;

    public function __construct(
        Context $context,
        DocumentTypeRepositoryInterface $docTypeRepository,
        CollectionFactory $collectionFactory,
        UrlViewModel $urlViewModel,
        ImageViewModel $imageViewModel,
        CollectionModifierInterface $collectionModifier,
        array $data = []
    ) {
        $this->docTypeRepository = $docTypeRepository;
        $this->collectionFactory = $collectionFactory;
        $this->urlViewModel = $urlViewModel;
        $this->imageViewModel = $imageViewModel;
        $this->collectionModifier = $collectionModifier;
        parent::__construct($context, $data);
    }

    public function getIdentities(): array
    {
        $documentType = $this->resolveDocumentType();

        return $documentType instanceof IdentityInterface ? $documentType->getIdentities() : [];
    }

    protected function _beforeToHtml(): ListByType
    {
        if (!$this->hasData('urlHelper')) {
            $this->setData('urlHelper', $this->urlViewModel);
        }
        if (!$this->hasData('imageHelper')) {
            $this->setData('imageHelper', $this->imageViewModel);
        }
        if (!$this->hasData('collection')) {
            $this->setData('collection', $this->createCollection());
        }
        if (!$this->hasData('target')) {
            $this->setData('target', '_blank');
        }
        if (!$this->getChildBlock('imageRenderer')) {
            $this->addChild(
                'imageRenderer',
                Template::class,
                ['template' => 'Opengento_DocumentWidget::document/image.phtml']
            );
        }
        if (!$this->getChildBlock('pager')) {
            $this->addChild('pager', Pager::class);
        }

        return parent::_beforeToHtml();
    }

    protected function _toHtml(): string
    {
        return $this->resolveDocumentType() ? parent::_toHtml() : '';
    }

    private function createCollection(): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('type_id', ['eq' => $this->getData('type_id')]);
        $this->collectionModifier->apply($collection);

        return $collection;
    }

    private function resolveDocumentType(): ?DocumentTypeInterface
    {

        if (!$this->hasData('documentType')) {
            try {
                $this->setData('documentType', $this->docTypeRepository->getById((int) $this->getData('type_id')));
            } catch (NoSuchEntityException $e) {
                $this->_logger->error($e->getLogMessage(), $e->getTrace());
                $this->setData('documentType');
            }
        }

        return $this->_getData('documentType');
    }
}
