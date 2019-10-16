<?php

namespace CupsGenerator;

use Exception;

/**
 * Class to generate a random cups.
 */
class Cups
{
    const TYPE_GAS = 'gas';
    const TYPE_ENERGY = 'energy';

    /**
     * Cups id.
     *
     * @param $string
     */
    private $id;

    /**
     * Generate a Random cups.
     *
     * @param string $type
     * @return string
     */
    public function generate(string $type = Cups::TYPE_ENERGY)
    {
        $reeId = $this->generateReeId($type);
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
     * @param  string $type
     * @return string
     */
    private function generateReeId(string $type)
    {
        switch ($type) {
            case static::TYPE_ENERGY:
                $start = '00';
                break;
            case static::TYPE_GAS:
                $start = '02';
                break;
            default:
                throw new Exception('Invalid CUPS type: ' . $type);
        }
        $random = mt_rand(0, 99);

        return $start . str_pad($random, 2, STR_PAD_LEFT);
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
