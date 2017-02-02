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
     * Genera los 4 numeros dados por la Red electrica de España
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
     * @return string
     */
    private function generateDistId()
    {
        if (PHP_INT_SIZE == 4) {
            return $this->generateRandomNumberWithRange(9)
                . $this->generateRandomNumberWithRange(3);
        }

        return $this->generateRandomNumberWithRange(12);
    }

    /**
     * @param $range
     * @return string
     */
    private function generateRandomNumberWithRange($range)
    {
        $randomNumber = mt_rand(0, str_repeat("9", $range));

        return str_pad($randomNumber, $range, '0', STR_PAD_LEFT);
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
     * Return array with control.
     *
     * @return string
     */
    private function getControlNumbersBy($id)
    {
        $controlNumber = $this->getControlNumbers();

        return $controlNumber[$id];
    }
}
