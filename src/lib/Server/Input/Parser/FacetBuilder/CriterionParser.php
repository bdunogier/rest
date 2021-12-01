<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Ibexa\Rest\Server\Input\Parser\FacetBuilder;

use Ibexa\Rest\Input\BaseParser;
use Ibexa\Contracts\Rest\Input\ParsingDispatcher;
use Ibexa\Contracts\Rest\Exceptions;
use Ibexa\Contracts\Core\Repository\Values\Content\Query\FacetBuilder\CriterionFacetBuilder;

/**
 * Parser for Criterion facet builder.
 */
class CriterionParser extends BaseParser
{
    /**
     * Parses input structure to a FacetBuilder object.
     *
     * @param array $data
     * @param \Ibexa\Contracts\Rest\Input\ParsingDispatcher $parsingDispatcher
     *
     * @throws \Ibexa\Contracts\Rest\Exceptions\Parser
     *
     * @return \Ibexa\Contracts\Core\Repository\Values\Content\Query\FacetBuilder\CriterionFacetBuilder
     */
    public function parse(array $data, ParsingDispatcher $parsingDispatcher)
    {
        if (!array_key_exists('Criterion', $data)) {
            throw new Exceptions\Parser('Invalid <Criterion> format');
        }

        return new CriterionFacetBuilder($data['Criterion']);
    }
}

class_alias(CriterionParser::class, 'EzSystems\EzPlatformRest\Server\Input\Parser\FacetBuilder\CriterionParser');
