<?php

namespace Tests;

use CupsGenerator\Cups;
use CupsValidate\Cups as CupsValidator;

/**
 * Cups generator test.
 *
 * @link https://es.wikipedia.org/wiki/C%C3%B3digo_Unificado_de_Punto_de_Suministro
 */
class CupsTest extends \PHPUnit_Framework_TestCase
{
    public function testHasNormalLength()
    {
        $cupsList = $this->cupsList();

        array_walk($cupsList, function ($cups) {
            $this->assertTrue(CupsValidator::validate($cups));
        });
    }

    private function cupsList()
    {
        return array_map(function () {
            return (new Cups())->generate();
        }, range(1, 50));
    }
}
