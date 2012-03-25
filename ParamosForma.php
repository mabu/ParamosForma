<?php
/**
 * Copyright 2012 Martynas Budriūnas
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once 'tfpdf/tfpdf.php';
require_once 'fpdi/fpdi.php';

class ParamosForma
{
    private $code;
    private $firstName;
    private $lastName;
    private $id;
    private $address;
    private $phone;
    private $duration;
    private $percent;
    private $percentFrac;
    private $encoding;
    private $pdf;

    /**
     * Inicijuojamas formos pildymas.
     * Nenurodyti formos laukai imami iš atitinkamų $_POST laukų.
     *
     * @param code         įmonės kodas
     * @param templateFile tuščios formos šablonas, ant kurio rašyti
     * @param id           formos lauko „Mokesčių mokėtojo identifikacinis
     * @param phone        formos lauko „Telefonas“ reikšmė
     * @param firstName    formos lauko „Vardas“ reikšmė
     * @param lastName     formos lauko „Pavardė“ reikšmė
     *                     numeris (asmens kodas)“ reikšmė
     * @param address      formos lauko „Adresas“ reikšmė
     * @param percent      remiamos procentinės dalies sveikoji dalis (0, 1, 2)
     * @param percentFrac  remiamos procentinės dalies trupmeninė dalis (00–99)
     * @param duration     keliems metams skirti paramą (VMI leidžia iki 5)
     * @param encoding     pateiktų duomenų koduotė
     */
    function __construct($code, $templateFile = 'paramos_forma.pdf', $id = NULL,
                         $phone = NULL, $firstName = NULL, $lastName = NULL,
                         $address = NULL, $percent = NULL, $percentFrac = NULL,
                         $duration = NULL, $encoding = NULL)
    {
        $this->code = $code;
        $this->setPost('firstName', $firstName);
        $this->setPost('lastName', $lastName);
        $this->setPost('id', $id);
        $this->setPost('address', $address);
        $this->setPost('phone', $phone);
        $this->setPost('duration', $duration);
        $this->setPost('percent', $percent);
        $this->setPost('percentFrac', $percentFrac);
        $this->encoding = (is_null($encoding) ? mb_http_input('P') : $encoding);
        if (false === $this->encoding) $this->encoding = 'UTF-8';

        $this->pdf = new FPDI('L'); // L nurodo gulsčią lapą
        $this->pdf->SetTitle('FR0512 v2');
        $this->pdf->addPage();
        $this->pdf->setSourceFile($templateFile);
        $this->pdf->useTemplate($this->pdf->importPage(1), 0, 0, 297, 210);
        $this->pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf',true);
        $this->pdf->SetFont('DejaVu', 'B', 11);
    }

    function setPost($name, $value)
    {
        $this->$name = (is_null($value) && isset($_POST[$name]) ?
	                $_POST[$name] : $value);
    }

    /**
     * Išsiunčia failą naršyklei.
     *
     * @param filename failo, kuris bus siunčiamas naršyklei, vardas
     */
    public function output($filename = 'parama.pdf')
    {
        $this->write(39.7, 14.75, $this->id, 11);
        $this->write(123.55, 14.75, $this->phone, 12);
        $this->write(11.65, 24.9, $this->firstName, 15);
        $this->write(109.7, 24.9, $this->lastName, 31);
        $this->write(11.65, 34.85, $this->address, 50);
        $this->pdf->Output($filename, 'D');
    }

    /**
     * Spausdina tekstą į langelius nurodytose koordinatėse.
     *
     * @param x x koordinatė
     * @param y y koordinatė
     * @param text spausdinamas tekstas
     * @param length ilgis, kurį viršijęs spausdinamas tekstas nukerpamas
     */
    private function write($x, $y, $text, $length)
    {
        $text = mb_strtoupper($text, $this->encoding);
        $length = min(mb_strlen($text, $this->encoding), $length);
        for ($i = 0; $i < $length; ++$i)
        {
            $this->pdf->SetXY($x + 5.165 * $i, $y);
	    $char = mb_substr($text, $i, 1, $this->encoding);
            $this->pdf->Cell(37, 47, $char, 0, 0, 'C');
        }
    }
}

?>
