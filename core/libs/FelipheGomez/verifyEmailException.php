<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
/** 
 * Class to validate the email address 
 * 
 * @author CodexWorld.com <contact@codexworld.com> 
 * @copyright Copyright (c) 2018, CodexWorld.com
 * @url https://www.codexworld.com
 */ 

namespace FelipheGomez;
/** 
 * verifyEmail exception handler 
 */ 
class verifyEmailException extends Exception { 

    /** 
     * Prettify error message output 
     * @return string 
     */ 
    public function errorMessage() {
        $errorMsg = $this->getMessage(); 
        return $errorMsg; 
    } 

} 