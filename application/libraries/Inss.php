<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Responsável por validar CTC/PT/SIPPS e colocar a formatação
 * Metodos Públicos: validaProtocolo()
 *                   formataProtocolo()
 *
 * @input: informar o número do protocolo.
 * Ex: new Protocolo('421562786137');
 *
 * @return validaProtocolo() TRUE para correto e FALSE para inválido
 *         formataProtocolo() retorna número formatado. Caso Tamaaho da string
 *         for diferente de 10,12 e 17 , será retornado a string sem formatação
 *
 * Demais métodos são protected
 *
 * @author Israel Eduardo Z M de Souza 2014
 */
class Inss {

  private $protocolo;

  /* Validação NB */

  protected function validarNB() {

    $valor = $soma = $dv = null;
    $vax = $this->protocolo;

    /* habilitar caso queira obter a espécie do benefício
      $especie = substr($vax, 0, 2);
      $especies = array(1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 15, 21, 22, 23, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 36, 37, 38, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 54, 55, 56, 57, 58, 59, 60, 68, 72, 76, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99);

      if ($especie == "" || !in_array($especie, $especies)) {
      echo "espécie não informada";
      }
    */

    /* retira a espécie do número  ex: 4212234567890 ficara 1234567890 */
    if (strlen($vax) == 12) {
      $valor = substr($vax, 2);
    } else if (strlen($vax) == 10) {
      $valor = $vax;
    } else {
      return FALSE;
    }


    $aux = substr($valor, 0, 1);
    $soma = $aux * 2;
    $posicao = 1;

    for ($i = 9; $i > 1; $i--) {
      $aux = substr($valor, $posicao++, 1);
      $soma += $aux * $i;
    }


    $dv = $soma % 11;
    // condição especial 0 e 1
      if ($dv == 0 || $dv == 1) {
        $dv = 0;
      } else {
        $dv = 11 - $dv;
      }


    // verificando digito verificador informado
    if (substr($valor, 9, 1) == $dv) {  // OK
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /* Validação CTC */
  protected function validarCTC() { #17
    $tam = strlen($this->protocolo) - 1;
    $peso = 2;
    $total = 0;
    $contador = NULL;
    $digito = substr($this->protocolo, -1);
    $num = substr($this->protocolo, 0, -1);

    for ($contador = $tam; $contador > 0; $contador--) {
      $total = $total + ($peso * substr($num, $contador - 1, 1));
      $peso++;
    }

    $dv = 11 - ($total % 11);

    if ($dv >= 10) {
      $dv = 0;
    }

    if ($dv != $digito) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /* Validação SIPPS */

  protected function validarSIPPS() {

    $numero = substr($this->protocolo, 0, 11) . substr($this->protocolo, 13, 2);

    $numeroCompleto = substr($this->protocolo, 0, 5) . "." . substr($this->protocolo, 5, 6) . "/" . substr($this->protocolo, 11, 4) . "-" . substr($this->protocolo, -2);


    for ($j = 0; $j < 2; $j++) {
      $dig = "";
      for ($i = 0; $i < 2; $i++) {
        $tamanho = strlen($numero);

        $peso = 2;
        $total = 0;
        $dv2 = "";


        for ($contador = $tamanho; $contador > 0; $contador--) {
          $total = $total + ($peso * substr($numero, $contador - 1, 1));
          $peso++;
        }

        $resto = $total % 11;

        $dv = 11 - $resto;

        if ($dv >= 10) {
          $dv = 1 - $resto;
        }
        if ($dv2 = "") {
          $dv2 = $dv;
        } else {
          $dv2 = ($dv2 * 10) + $dv;
        }

        $dig = $dig . $dv;
        $numero = $numero . $dv;
      }



      if ($dig != substr($numeroCompleto, 18, 3)) {

        $erro = TRUE;
        $numero = substr($numeroCompleto, 0, 5) . substr($numeroCompleto, 6, 6) . substr($numeroCompleto, 13, 4);
      } else {

        $j++;
        $erro = FALSE;
      }
    }

    if ($erro) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /* Responsável por selecionar qual tipo de validação é recomendado para o protocolo informado */

  public function validaProtocolo($protocolo) {

    if (empty($protocolo)) {
      throw new Exception("Obrigatório Informar protocolo no objeto");
    }
    $this->protocolo = preg_replace("/[^0-9]/", "", htmlentities($protocolo, ENT_QUOTES));

    $tamanho = strlen($this->protocolo);

    switch ($tamanho) {
      case 10:
      case 12: return $this->validarNB();
      break;
      case 17: return $this->selecionaValidacaoProtocoloCTCSIPPS();
      break;
      default:
      return FALSE;
      break;
    }
  }

  /*
   * Define qual validação será aplicada SIPPS ou CTC
   * testa as duas pra ver se é válido em algum deles.
   */

  protected function selecionaValidacaoProtocoloCTCSIPPS() {

    /* $faixa1 = 34000;
        $faixa2 = 45999;

    $inicio = substr($this->protocolo, 0, 5);

    if ($inicio >= $faixa1 && $inicio <= $faixa2) {
    return $this->validarSIPPS();
    }

    return $this->validarCTC(); */

    return ($this->validarSIPPS() || $this->validarCTC());
  }

  /* Formatação Benefício */

  protected function colocaFormatacaoBeneficio() {
    $str = $this->protocolo;

    if (strlen($str) == 10) {
      $ret = substr($str, 0, 3) . "." . substr($str, 3, 3) . "." . substr($str, 6, 3) . "-" . substr($str, -1);
    } else {
      $ret = substr($str, 0, 2) . "/" . substr($str, 2, 3) . "." . substr($str, 5, 3) . "." . substr($str, 8, 3) . "-" . substr($str, 11, 2);
    }


    return $ret;
  }

  /* Formatação CTC  */

  protected function colocaFormatacaoCTC() {
    $str = $this->protocolo;

    return substr($str, 0, 8) . "." . substr($str, 8, 1) . "." . substr($str, 9, 5) . "/" . substr($str, 14, 2) . "-" . substr($str, 16, 1);
  }

  /* Formatação SIPPS */

  protected function colocaFormatacaoSIPPS() {
    $str = $this->protocolo;

    return substr($str, 0, 5) . "." . substr($str, 5, 6) . "/" . substr($str, 11, 4) . "-" . substr($str, 15, 2);
  }

  /* Definir qual tipo de formatação será aplicada ao protocolo */

  public function formataProtocolo($protocolo) {

    if (empty($protocolo)) {
      throw new Exception("Obrigatório Informar protocolo no objeto");
    }
    $this->protocolo = preg_replace("/[^0-9]/", "", htmlentities($protocolo, ENT_QUOTES));

    $str = $this->protocolo;

    $tamanho = strlen($str);

    switch ($tamanho) {
      case 10:
      case 12: return $this->colocaFormatacaoBeneficio();
      break;
      case 17: return $this->selecionaProtocoloCTCSIPPS();
      break;
      default:
      return $str;
      break;
    }
  }

  /* Define validação entre SIPPS e CTC */

  protected function selecionaProtocoloCTCSIPPS() {

    $faixa1 = 34000;
    $faixa2 = 45999;

    $inicio = substr($this->protocolo, 0, 5);

    if ($inicio >= $faixa1 && $inicio <= $faixa2) {
      return $this->colocaFormatacaoSIPPS();
    }

    return $this->colocaFormatacaoCTC();
  }

}
