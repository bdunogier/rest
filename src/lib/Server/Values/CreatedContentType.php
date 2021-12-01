<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Ibexa\Rest\Server\Values;

use Ibexa\Contracts\Core\Repository\Values\ValueObject;

/**
 * Struct representing a freshly created ContentType.
 */
class CreatedContentType extends ValueObject
{
    /**
     * The created content type.
     *
     * @var \Ibexa\Rest\Server\Values\RestContentType
     */
    public $contentType;
}

class_alias(CreatedContentType::class, 'EzSystems\EzPlatformRest\Server\Values\CreatedContentType');
