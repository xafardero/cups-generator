<?php

namespace CupsGenerator;

/**
 * Class to generate a random cups.
 */
class Cups
{
    /**
     * Cups id.
     *
     * @param $string
     */
    private $id;

    /**
     * Generate a Random cups.
     *
     * @return string
     */
    public function generate()
    {
        $reeId = $this->generateReeId();
        $distId = $this->generateDistId();

        $control = ($reeId.$distId) % 529;
        $division = $control / 23;
        $resto = $control % 23;

        $this->id = $this->getCountry()
            . $reeId
            . $distId
            . $this->getControlNumbersBy($division)
            . $this->getControlNumbersBy($resto);

        return $this->id;
    }

    /**
     * Genera los 4 numeros dados por la Red electrica de EspaÃ±a.
     *
     * @todo improve this for
     *
     * @return string
     */
    private function generateReeId()
    {
        $random = mt_rand(0, 9999);

        return str_pad($random, 4, STR_PAD_LEFT);
    }

    /**
     * Genera los 12 numeros Id del distribuidor.
     *
     * @todo improve this for
     *
     * @return string
     */
    private function generateDistId()
    {
        if (PHP_INT_SIZE == 4) {
            $random = mt_rand(0, 999999999);
            $id = str_pad($random, 9, '0', STR_PAD_LEFT);
            $random = mt_rand(0, 999);
            $id .= str_pad($random, 3, '0', STR_PAD_LEFT);
        } else {
            $random = mt_rand(0, 999999999999);
            $id = str_pad($random, 12, '0', STR_PAD_LEFT);
        }

        return $id;
    }

    /**
     * Retorna ISO pais.
     *
     * @return string
     */
    private function getCountry()
    {
        return 'ES';
    }

    /**
     * Retorna array with control.
     *
     * @return array
     */
    private function getControlNumbers()
    {
        return [
            0  => 'T',
            1  => 'R',
            2  => 'W',
            3  => 'A',
            4  => 'G',
            5  => 'M',
            6  => 'Y',
            7  => 'F',
            8  => 'P',
            9  => 'D',
            10 => 'X',
            11 => 'B',
            12 => 'N',
            13 => 'J',
            14 => 'Z',
            15 => 'S',
            16 => 'Q',
            17 => 'V',
            18 => 'H',
            19 => 'L',
            20 => 'C',
            21 => 'K',
            22 => 'E',
        ];
    }

    /**
     * Retorna array with control.
     *
     * @todo improve the return
     *
     * @return string
     */
    private function getControlNumbersBy($id)
    {
        $controlNumber = $this->getControlNumbers();

        return $controlNumber[$id];
    }
}
