<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Ibexa\Rest\Server\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

/**
 * Struct representing a freshly created URLWildcard.
 */
class CreatedURLWildcard extends ValueObject
{
    /**
     * The created URL wildcard.
     *
     * @var \eZ\Publish\API\Repository\Values\Content\URLWildcard
     */
    public $urlWildcard;
}

class_alias(CreatedURLWildcard::class, 'EzSystems\EzPlatformRest\Server\Values\CreatedURLWildcard');
