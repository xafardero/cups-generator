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
        $reeId = $this->_generateReeId();
        $distId = $this->_generateDistId();

        $control = ($reeId.$distId) % 529;
        $division = $control / 23;
        $resto = $control % 23;

        $this->id = $this->_getCountry()
            .$reeId
            .$distId
            .$this->_getControlNumbersBy($division)
            .$this->_getControlNumbersBy($resto);

        return $this->id;
    }

    /**
     * Genera los 4 numeros dados por la Red electrica de EspaÃ±a.
     *
     * @todo improve this for
     *
     * @return string
     */
    private function _generateReeId()
    {
        $id = mt_rand(0, 9999);

        for ($idLength = strlen($id); $idLength < 4; $idLength++) {
            $id = '0'.$id;
        }

        return $id;
    }

    /**
     * Genera los 12 numeros Id del distribuidor.
     *
     * @todo improve this for
     *
     * @return string
     */
    private function _generateDistId()
    {
        if (PHP_INT_SIZE == 4) {
            $rand = mt_rand(0, 999999999);
            $id = str_pad($rand, 9, '0', STR_PAD_LEFT);
            $rand = mt_rand(0, 999);
            $id .= str_pad($rand, 3, '0', STR_PAD_LEFT);
        } else {
            $rand = mt_rand(0, 999999999999);
            $id = str_pad($rand, 12, '0', STR_PAD_LEFT);
        }

        return $id;
    }

    /**
     * Retorna ISO pais.
     *
     * @return string
     */
    private function _getCountry()
    {
        return 'ES';
    }

    /**
     * Retorna array with control.
     *
     * @return array
     */
    private function _getControlNumbers()
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
    private function _getControlNumbersBy($id)
    {
        $controlNumber = $this->_getControlNumbers();

        return $controlNumber[(int) $id];
    }
}
