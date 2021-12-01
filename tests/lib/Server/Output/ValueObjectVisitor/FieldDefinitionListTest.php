<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Ibexa\Tests\Rest\Server\Output\ValueObjectVisitor;

use Ibexa\Tests\Rest\Output\ValueObjectVisitorBaseTest;
use Ibexa\Rest\Server\Output\ValueObjectVisitor;
use Ibexa\Rest\Server;
use Ibexa\Core\Repository\Values;

/**
 * @todo coverage add unit test for a content type draft
 */
class FieldDefinitionListTest extends ValueObjectVisitorBaseTest
{
    /**
     * @return \DOMDocument
     */
    public function testVisitFieldDefinitionList()
    {
        $visitor = $this->getVisitor();
        $generator = $this->getGenerator();

        $generator->startDocument(null);

        $fieldDefinitionList = $this->getBasicFieldDefinitionList();

        $this->getVisitorMock()->expects($this->exactly(2))
            ->method('visitValueObject')
            ->with($this->isInstanceOf(Server\Values\RestFieldDefinition::class));

        $this->addRouteExpectation(
            'ezpublish_rest_loadContentTypeFieldDefinitionList',
            ['contentTypeId' => $fieldDefinitionList->contentType->id],
            "/content/types/{$fieldDefinitionList->contentType->id}/fieldDefinitions"
        );

        $visitor->visit(
            $this->getVisitorMock(),
            $generator,
            $fieldDefinitionList
        );

        $result = $generator->endDocument(null);

        $this->assertNotNull($result);

        $dom = new \DOMDocument();
        $dom->loadXml($result);

        return $dom;
    }

    protected function getBasicFieldDefinitionList()
    {
        return new Server\Values\FieldDefinitionList(
            new Values\ContentType\ContentType(
                [
                    'id' => 'contentTypeId',
                    'status' => Values\ContentType\ContentType::STATUS_DEFINED,
                    'fieldDefinitions' => [],
                ]
            ),
            [
                new Values\ContentType\FieldDefinition(
                    ['id' => 'fieldDefinitionId_1']
                ),
                new Values\ContentType\FieldDefinition(
                    ['id' => 'fieldDefinitionId_2']
                ),
            ]
        );
    }

    public function provideXpathAssertions()
    {
        return [
            [
                '/FieldDefinitions[@href="/content/types/contentTypeId/fieldDefinitions"]',
            ],
            [
                '/FieldDefinitions[@media-type="application/vnd.ez.api.FieldDefinitionList+xml"]',
            ],
        ];
    }

    /**
     * @param string $xpath
     * @param \DOMDocument $dom
     *
     * @depends testVisitFieldDefinitionList
     * @dataProvider provideXpathAssertions
     */
    public function testGeneratedXml($xpath, \DOMDocument $dom)
    {
        $this->assertXPath($dom, $xpath);
    }

    /**
     * Get the Content visitor.
     *
     * @return \Ibexa\Rest\Server\Output\ValueObjectVisitor\FieldDefinitionList
     */
    protected function internalGetVisitor()
    {
        return new ValueObjectVisitor\FieldDefinitionList();
    }
}

class_alias(FieldDefinitionListTest::class, 'EzSystems\EzPlatformRest\Tests\Server\Output\ValueObjectVisitor\FieldDefinitionListTest');
