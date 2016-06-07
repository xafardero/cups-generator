<?php

use CupsGenerator\Cups;

/**
 * Cups generator test.
 *
 * @link https://es.wikipedia.org/wiki/C%C3%B3digo_Unificado_de_Punto_de_Suministro
 */
class CupsTest extends PHPUnit_Framework_TestCase
{
    public function testHasNormalLength()
    {
        $this->assertEquals(strlen((new Cups())->generate()), 20);
    }
}
