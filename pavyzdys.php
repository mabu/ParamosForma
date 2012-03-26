<?php
if (!empty($_POST))
{
    require_once 'ParamosForma.php';
    $form = new ParamosForma('300628321'); // skliausteliuose – įmonės kodas
    $form->output();
    die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="lt" lang="lt">
  <head>
    <title>2% paramos forma</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
      table#paramos_forma td
      {
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <p>
        Jūs galite mums paskirti iki 2% pajamų mokesčio sumos, kurią sumokėjote
        valstybei per praeitus metus. Užpildę laukelius gausite parengtą prašymo
        formą su Jūsų duomenimis, kurią tereikės iki gegužės 1 d. pristatyti
        arba nusiųsti paštu į apskrities valstybinę mokesčių inspekciją.
        Lietuvos apskričių VMI adresus ir kontaktus rasite
        <a href="http://www.vmi.lt/lt/?itemId=20900">čia</a>.
    </p>

    <form action="" method="post">
        <table style="margin: 0pt auto;" id="paramos_forma">
          <tbody>
            <tr>
              <td style="text-align: right">
                Mokesčių mokėtojo identifikacinis numeris (asmens kodas)
              </td>
              <td>
                <input name="id" maxlength="11" type="text" />
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Telefonas
              </td>
              <td>
                <input name="phone" value="" maxlength="12" type="text" />
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Vardas
              </td>
              <td>
                <input name="firstName" maxlength="15" type="text" />
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Pavardė
              </td>
              <td>
                <input name="lastName" maxlength="31" type="text" />
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Adresas
              </td>
              <td>
                <input name="address" maxlength="50" type="text" />
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Prašoma pervesti pajamų mokesčio dalis
              </td>
              <td>
                <select style="width: 40px;" name="percent">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2" selected="selected">2</option>
                </select>,<input style="width: 2em;" name="percentFrac"
                                      value="00" maxlength="2" type="text" />
                %
              </td>
            </tr>
            <tr>
              <td style="text-align: right">
                Kuriam laikotarpiui skiriate paramą
              </td>
              <td>
                <select name="duration">
                  <option value="1">1 metams</option>
                  <option value="2">2 metams</option>
                  <option value="3">3 metams</option>
                  <option value="4">4 metams</option>
                  <option value="5">5 metams</option>
                </select>
              </td>
            </tr>
            <tr>
              <td />
              <td>
                <input value="Atsisiųsti" type="submit" />
                <input value="Išvalyti laukus" type="reset" />
              </td>
            </tr>
          </tbody>
        </table>
    </form>
    <p>
      Skirti 2% pajamų mokesčio galite ir užpildę elektroninę formą VMI
      <a href="http://deklaravimas.vmi.lt">elektroninio deklaravimo
      sistemoje</a> (jeigu naudojatės elektronine bankininkyste), tuomet
      nereikės siųsti arba nešti popierinės formos originalo į VMI.
    </p>
    <p>
      Daugiau informacijos apie 2% paramą galite rasti
      <a href="http://www.vmi.lt/lt/?itemId=10146527">VMI svetainėje</a>.
    </p>
  </body>
</html>
