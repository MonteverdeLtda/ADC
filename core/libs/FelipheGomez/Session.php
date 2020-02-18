<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * @version: 1.0
 *
 * ******************************/
namespace FelipheGomez;

class Session
{
    public $session_id;
    private $session_token;
    
    public function __construct()
    {
            $this->initSession();   
            $this->setSessionToken();
            $this->setSessionValue('_session_token_', $this->session_token);
    }
    /*
    * Configura caché de sesión y la inicializa
    * 
    * @params: void
    * @return: void
    */
    private function initSession()
    {
        $this->setSessionCacheLimiter('private');
        $this->setSessionCacheExpire(0);
        $this->setCookieParams();
        session_start();
        $this->sessionRegenerateId();
    }
    /*
    * Establece el limitador del caché actual
    * 
    * @params: String limiter: el limitador
    * @return: void
    */
    private function setSessionCacheLimiter($limiter)
    {
        session_cache_limiter($limiter);
    }
    /*
    * Establece la caducidad del caché en minutos
    * 
    * @params: Int minutes: duración del caché
    * @return: void
    */
    private function setSessionCacheExpire($minutes)
    {
        session_cache_expire($minutes);
    }
    /*
    * Establece los parámetros de la cookie. Su efecto dura lo mismo que el script invocador
    * 
    * @params: Int minutes: duración del caché
    * @return: void
    */
    private function setCookieParams()
    {
        $cookie_params = session_get_cookie_params();
        session_set_cookie_params(
                $cookie_params['path'],
                $cookie_params['domain'],
                'SECURE',
                true);
    }
    /*
    * Crea un token personalizado para mayor seguridad
    * 
    * @params: void
    * @return: void
    */
    private function setSessionToken()
    {
        $this->session_token = sha1($this->session_id . 'DeveloperoShield');
    }
    /*
    * Asigna el id de sesión al atributo session_id
    * 
    * @params: void
    * @return: void
    */
    public function setSessionId()
    {
        $this->session_id = session_id();
    }
    /*
    * Recupera el valor de session_id
    * 
    * @params: void
    * @return: void
    */
    public function getSessionId()
    {
        return $this->session_id;
    }
    /*
    * Crea un nuevo valor al array $_SESSION
    * 
    * @params: 
    *       String name_key: nombre de la llave del array de sesión
    *   String value: el valor asociado a la llave
    * @return: void
    */
    public function setSessionValue($name_key, $value)
    {
        $_SESSION[$name_key] = $value;
    }
    /*
    * Recupera un elemento del array $_SESSION
    * 
    * @params: String session_value: la llave del array a recuperar
    * @return: el valor del elemento del array solicitado. Si no existe, false
    */
    public function getSessionValue($session_value)
    {
        if (! empty($_SESSION[$session_value]))
            return $_SESSION[$session_value];
        return false;
    }
    /*
    * Elimina un elemento del array $_SESSION
    * 
    * @params: String session_value: la llave del array a eliminar
    * @return: void
    */
    public function removeSessionValue($session_value)
    {
        if (! empty( $_SESSION[$session_value]))
            unset ($_SESSION[$session_value]);
    }
    /*
    * Valida sesión iniciada usando session_token y session_id 
    *   Al autogenerarse al instanciar, siempre deben ser iguales
    * 
    * @params: void
    * @return: true en caso de éxito, false lo contrario
    */
    public function checkSession()
    {
        if ($this->session_token === $_SESSION['_session_token_'] and $this->session_id === session_id() )
            return true;
        
        return false;
    }
    /*
    * Regenera el session_id cuando se deje de hacer referencia al objeto 
    * 
    * @params: void
    * @return: void
    */
    public function __destruct()
    {
        $this->sessionRegenerateId();
    }
    /*
    * Regenera el session_id
    * 
    * @params: void
    * @return: void
    */
    private function sessionRegenerateId()
    {
        session_regenerate_id();
        $this->setSessionId();
    }
    /*
    * Borra los datos y destruye la sesión.
    * 
    * @params: void
    * @return: void
    */
    public function destroy()
    {
        $this->session_id = '';
        session_unset();
        session_destroy();
    }
}