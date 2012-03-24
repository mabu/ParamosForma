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

$pdf = new FPDI('L'); // L nurodo gulsčią lapą
$pdf->addPage();
$pdf->setSourceFile('paramos_forma.pdf'); // neužpildyto formos šablono failas
$pdf->useTemplate($pdf->importPage(1), 0, 0, 297, 210);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf',true);
$pdf->SetFont('DejaVu', 'B', 11);
$pdf->SetXY(67, 58);
$pdf->Write(1, mb_strtoupper('Įlinkdama fechtuotojo špaga, sublykčiojusi pragręžė apvalų arbūzą', 'UTF-8'));
$pdf->Output('parama.pdf', 'D'); // failo pavadinimas, siuntimas naršyklei

?>
