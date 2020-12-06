<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\ViewModel;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Api\Data\DocumentTypeInterface;
use Opengento\Document\Api\DocumentTypeRepositoryInterface;
use Psr\Log\LoggerInterface;

final class DocumentType implements ArgumentInterface
{
    /**
     * @var DocumentTypeRepositoryInterface
     */
    private $docTypeRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $criteriaBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var DocumentTypeInterface[]
     */
    private $documentTypes;

    public function __construct(
        DocumentTypeRepositoryInterface $docTypeRepository,
        SearchCriteriaBuilder $criteriaBuilder,
        LoggerInterface $logger
    ) {
        $this->docTypeRepository = $docTypeRepository;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->logger = $logger;
    }

    public function getList()
    {
        if (!$this->documentTypes) {
            try {
                $this->documentTypes = $this->docTypeRepository->getList($this->criteriaBuilder->create());
            } catch (LocalizedException $e) {
                $this->logger->error($e->getLogMessage(), $e->getTrace());

                $this->documentTypes = [];
            }
        }

        return $this->documentTypes->getItems();
    }
}
