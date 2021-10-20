<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Ibexa\Rest\Server\Output\ValueObjectVisitor;

use Ibexa\Contracts\Rest\Output\ValueObjectVisitor;
use Ibexa\Contracts\Rest\Output\Generator;
use Ibexa\Contracts\Rest\Output\Visitor;

/**
 * UserGroupList value object visitor.
 */
class UserGroupList extends ValueObjectVisitor
{
    /**
     * Visit struct returned by controllers.
     *
     * @param \EzSystems\EzPlatformRest\Output\Visitor $visitor
     * @param \EzSystems\EzPlatformRest\Output\Generator $generator
     * @param \EzSystems\EzPlatformRest\Server\Values\UserGroupList $data
     */
    public function visit(Visitor $visitor, Generator $generator, $data)
    {
        $generator->startObjectElement('UserGroupList');
        $visitor->setHeader('Content-Type', $generator->getMediaType('UserGroupList'));
        //@todo Needs refactoring, disabling certain headers should not be done this way
        $visitor->setHeader('Accept-Patch', false);

        $generator->startAttribute('href', $data->path);
        $generator->endAttribute('href');

        $generator->startList('UserGroup');
        foreach ($data->userGroups as $userGroup) {
            $visitor->visitValueObject($userGroup);
        }
        $generator->endList('UserGroup');

        $generator->endObjectElement('UserGroupList');
    }
}

class_alias(UserGroupList::class, 'EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor\UserGroupList');
