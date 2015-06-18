<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Form Validation Extension
 */
class MY_Form_validation extends CI_Form_validation {
  protected $CI;

  public function __construct()
  {
    parent::__construct();

    $this->_error_prefix = '<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i><span>';
    $this->_error_suffix = '</span></div>';
    $this->CI =& get_instance();
  }

  function validar_protocolo($protocolo)
  {
    $this->CI->form_validation->set_message('validar_protocolo', 'Erro');

    $inss = $this->CI->load->library('inss');
    if ($this->CI->inss->validaProtocolo($protocolo)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   *  MY_Form_validation::valid_url
   * @abstract Ensures a string is a valid URL
   */
  function valid_url($url) {
    if(preg_match("/^http(|s):\/{2}(.*)\.([a-z]){2,}(|\/)(.*)$/i", $url)) {
      if(filter_var($url, FILTER_VALIDATE_URL)) return TRUE;
    }
    $this->CI->form_validation->set_message('valid_url', 'The %s must be a valid URL.');
    return FALSE;
  }

  /**
   * MY_Form_validation::alpha_extra()
   * @abstract Alpha-numeric with periods, underscores, spaces and dashes
   */
  function alpha_extra($str) {
    $this->CI->form_validation->set_message('alpha_extra', 'The %s may only contain alpha-numeric characters, spaces, periods, underscores & dashes.');
    return ( ! preg_match("/^([\.\s-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
  }

  /**
   * MY_Form_validation::numeric_comma()
   * @abstract Numeric and commas characters
   */
  function numeric_comma($str) {
    $this->CI->form_validation->set_message('numeric_comma', 'The %s may only contain numeric & comma characters.');
    return ( ! preg_match("/^(\d+,)*\d+$/", $str)) ? FALSE : TRUE;
  }

  /**
   * MY_Form_validation::matches_pattern()
   * @abstract Ensures a string matches a basic pattern
   */
  function matches_pattern($str, $pattern) {
    if (preg_match('/^' . $pattern . '$/', $str)) return TRUE;
    $this->CI->form_validation->set_message('matches_pattern', 'The %s field does not match the required pattern.');
    return FALSE;
  }

}

  /* End of file MY_form_validation.php */
/* Location: ./{APPLICATION}/libraries/MY_form_validation.php */