<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentWidget\Model\Document;

use Magento\Framework\Session\SessionManager;
use Magento\Framework\Session\Storage;

class Session extends SessionManager
{
    public const NAMESPACE = 'opengento_document_widget';

    /**
     * @var Storage
     */
    protected $storage;

    public function setData(string $key, string $value): void
    {
        $this->storage->setData($key, $value);
    }
}
