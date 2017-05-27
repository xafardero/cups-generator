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
        $mod = $control % 23;

        $this->id = $this->getCountry()
            .$reeId
            .$distId
            .$this->getControlNumbersBy($division)
            .$this->getControlNumbersBy($mod);

        return $this->id;
    }

    /**
     * Generate the 4 numbers given by the Red electrica from España.
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
                .$this->generateRandomNumberWithRange(3);
        }

        return $this->generateRandomNumberWithRange(12);
    }

    /**
     * @param $range
     *
     * @return string
     */
    private function generateRandomNumberWithRange($range)
    {
        $randomNumber = mt_rand(0, str_repeat('9', $range));

        return str_pad($randomNumber, $range, '0', STR_PAD_LEFT);
    }

    /**
     * Returns the country code.
     *
     * @return string
     */
    private function getCountry()
    {
        return 'ES';
    }

    /**
     * Returns an array with control Digit.
     *
     * @return array
     */
    private function getControlNumbers()
    {
        return [
            'T',
            'R',
            'W',
            'A',
            'G',
            'M',
            'Y',
            'F',
            'P',
            'D',
            'X',
            'B',
            'N',
            'J',
            'Z',
            'S',
            'Q',
            'V',
            'H',
            'L',
            'C',
            'K',
            'E',
        ];
    }

    /**
     * Return array with control.
     *
     * @param $id
     *
     * @return string
     */
    private function getControlNumbersBy($id)
    {
        $controlNumber = $this->getControlNumbers();

        return $controlNumber[$id];
    }
}
