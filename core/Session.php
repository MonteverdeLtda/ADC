<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Clase básica para adminsitrar sesiones
 *
 * ******************************/

// class Session extends FelipheGomez\Session
class Session{
  /**
   * Inicializa la sesión
   */
  public function __construct(){
    if ( $this->is_session_started() === FALSE ) @session_start();
    $this->reLoad();
  }
  public function is_session_started(){
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
  }

  public function reLoad(){
    if(isset($_SESSION['user'])){
        foreach($_SESSION['user'] as $k => $v){
            $this->{$k} = $_SESSION['user'][$k];
        }   
    }
  }

  public function isGuest(){
    $r = isset($_SESSION['user']) && is_array($_SESSION['user']) ? false : true;
    return $r;
  }

  public function setAll($session = null){
        if($session != null){
            $_SESSION['user'] = (array) $session;
        }
  }

  /**
   * Agrega un elemento a la sesión
   * @param string $key la llave del array de sesión
   * @param string $value el valor para el elemento de la sesión
   */
  public function add($key, $value){
    $_SESSION['user'][$key] = $value;
  }
  /**
   * Retorna un elemento a la sesión
   * @param string $key la llave del array de sesión
   * @return string el valor del array de sesión si tiene valor
   */
  public function get($key){
    $this->reLoad();
    return !empty($_SESSION['user'][$key]) ? $_SESSION['user'][$key] : null;
  }
  /**
   * Retorna todos los valores del array de sesión
   * @return el array de sesión completo
   */
  public function getAll(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : [];
  }
  /**
   * Remueve un elemento de la sesión
   * @param string $key la llave del array de sesión
   */
  public function remove($key){
    if(!empty($_SESSION['user'][$key]))
      unset($_SESSION['user'][$key]);
  }
  /**
   * Cierra la sesión eliminando los valores
   */
  public function close(){
    session_unset();
    session_destroy();
  }
  /**
   * Retorna el estatus de la sesión
   * @return string el estatus de la sesión
   */
  public function getStatus(){
    return session_status();
  }
  /**
   * Retorna string default
   * @return string
   */
  public function __toString(){
    return json_encode($this->getAll());
  }
  /**
   * Retorna array default
   * @return string
   */
  public function __sleep(){
    return array_keys($this->getAll());
  }
  
  public function getId(){
	  return !isset($_SESSION['user']['id']) ? 0 : $_SESSION['user']['id'];
  }
}