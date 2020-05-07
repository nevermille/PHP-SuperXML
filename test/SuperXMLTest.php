<?php

namespace Lianhua\SuperXML\Test;

use Lianhua\SuperXML\SuperXML;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

/*
SuperXML Library
Copyright (C) 2020  Lianhua Studio

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class SuperXMLTest extends TestCase
{
    /**
     * @brief Tests the XML loading
     * @return void
     * @throws ExpectationFailedException
     */
    public function testLoad()
    {
        $xml = new SuperXML(__DIR__ . DIRECTORY_SEPARATOR . "xml" . DIRECTORY_SEPARATOR . "01.xml");
        $this->assertNotNull($xml);
    }

    /**
     * @brief Tests the XPath reading functions
     * @return void
     * @throws ExpectationFailedException
     */
    public function testXpath()
    {
        $xml = new SuperXML(__DIR__ . DIRECTORY_SEPARATOR . "xml" . DIRECTORY_SEPARATOR . "01.xml");
        $nodes = $xml->xpathQuery("/document/fruits/fruit");
        $evalNodes = $xml->xpathEval("/document/fruits/fruit");

        $this->assertEquals(3, count($nodes));
        $this->assertEquals(3, count($evalNodes));

        foreach ($nodes as $node) {
            $this->assertContains($node->nodeValue, ["Banana", "Apple", "Pear"]);
        }

        foreach ($evalNodes as $node) {
            $this->assertContains($node->nodeValue, ["Banana", "Apple", "Pear"]);
        }

        $evalCount = $xml->xpathEval("count(/document/fruits/fruit)");
        $this->assertEquals(3, $evalCount);
    }
}
