<?php


class GenerateCoinToLetters
{


    public function __construct()
    {
    }

    private function Unidades($num)
    {

        switch ($num) {
            case 1:
                return "UNO";
            case 2:
                return "DOS";
            case 3:
                return "TRES";
            case 4:
                return "CUATRO";
            case 5:
                return "CINCO";
            case 6:
                return "SEIS";
            case 7:
                return "SIETE";
            case 8:
                return "OCHO";
            case 9:
                return "NUEVE";
        }

        return "";
    }

    public function Decenas($num)
    {

        $decena = floor($num / 10);
        $unidad = $num - ($decena * 10);

        switch ($decena) {
            case 1:
                switch ($unidad) {
                    case 0:
                        return "DIEZ";
                    case 1:
                        return "ONCE";
                    case 2:
                        return "DOCE";
                    case 3:
                        return "TRECE";
                    case 4:
                        return "CATORCE";
                    case 5:
                        return "QUINCE";
                    default:
                        return "DIECI" . $this->Unidades($unidad);
                }
            case 2:
                switch ($unidad) {
                    case 0:
                        return "VEINTE";
                    default:
                        return "VEINTI" . $this->Unidades($unidad);
                }
            case 3:
                return $this->DecenasY("TREINTA", $unidad);
            case 4:
                return $this->DecenasY("CUARENTA", $unidad);
            case 5:
                return $this->DecenasY("CINCUENTA", $unidad);
            case 6:
                return $this->DecenasY("SESENTA", $unidad);
            case 7:
                return $this->DecenasY("SETENTA", $unidad);
            case 8:
                return $this->DecenasY("OCHENTA", $unidad);
            case 9:
                return $this->DecenasY("NOVENTA", $unidad);
            case 0:
                return $this->Unidades($unidad);
        }
    }

    private function DecenasY($strSin, $numUnidades)
    {
        if ($numUnidades > 0)
            return $strSin . " Y " . $this->Unidades($numUnidades);

        return $strSin;
    }

    function Centenas($num)
    {

        $centenas = floor($num / 100);
        $decenas = $num - ($centenas * 100);

        switch ($centenas) {
            case 1:
                if ($decenas > 0)
                    return "CIENTO " . $this->Decenas($decenas);
                return "CIEN";
            case 2:
                return "DOSCIENTOS " . $this->Decenas($decenas);
            case 3:
                return "TRESCIENTOS " . $this->Decenas($decenas);
            case 4:
                return "CUATROCIENTOS " . $this->Decenas($decenas);
            case 5:
                return "QUINIENTOS " . $this->Decenas($decenas);
            case 6:
                return "SEISCIENTOS " . $this->Decenas($decenas);
            case 7:
                return "SETECIENTOS " . $this->Decenas($decenas);
            case 8:
                return "OCHOCIENTOS " . $this->Decenas($decenas);
            case 9:
                return "NOVECIENTOS " . $this->Decenas($decenas);
        }

        return $this->Decenas($decenas);
    }


    function Seccion($num, $divisor, $strSingular, $strPlural)
    {
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $letras = "";

        if ($cientos > 0)
            if ($cientos > 1)
                $letras = $this->Centenas($cientos) . " " .$strPlural;
            else
                $letras = $strSingular;
            
        
        if ($resto > 0)
            $letras .= "";
        

        return $letras;
    }

    function Miles($num)
    {
        $divisor = 1000;
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $strMiles = $this->Seccion($num, $divisor, "MIL", "MIL");
        $strCentenas = $this->Centenas($resto);

        if ($strMiles == "")
            return $strCentenas;

        return $strMiles . " " . $strCentenas;

        //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
    }

    function Millones($num)
    {
        $divisor = 1000000;
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $strMillones = $this->Seccion($num, $divisor, "UN MILLON", "MILLONES");
        $strMiles = $this->Miles($resto);

        if ($strMillones == "")
            return $strMiles;

        return $strMillones . " ". $strMiles;

        //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
    }

    public function getResult($num, $moneda)
    {
        $numero = $num;
        $arnum = explode(".", $numero);

        if (count($arnum) == 0) {
            "0";
        } else {

            $num = 0;
            $decimal = "00";

            if (count($arnum) > 1) {
                $num = intval($arnum[0]);
                $decimal = intval($arnum[1]) < 10 ? "0" . intval($arnum[1]) : intval($arnum[1]);
            } else {
                $num = intval($arnum[0]);
                $decimal = "00";
            }

            if ($num == 0)
                return "CERO CON " . $decimal . "/100 " . strtoupper($moneda);
            
            if ($num == 1)
                return $this->Millones($num) . " CON " .$decimal . "/100 " . strtoupper($moneda);
            else
                return $this->Millones($num) . " CON " . $decimal ."/100 " . strtoupper($moneda);
            

        }
    }
}
