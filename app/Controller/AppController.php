<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password'
                    ),
                )
            ),
            'loginRedirect' => array('controller' => 'reservas', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login'),
            'authError' => 'Debe ingresar al sistema para acceder a esta página.',
            'loginError' => 'Email o contraseña incorrecta. Intentalo de nuevo.',
        )
    );
    public $helpers = array('Form' => array('className' => 'BootstrapForm'));

    public function beforeFilter() {
        $this->Auth->allow('login');
        $this->Auth->flash['element'] = 'flash_danger';
    }

    public function isAuthorized($usuario) {
// Here is where we should verify the role and give access based on role

        return true;
    }

    public function cambiarfecha_mysql($fecha) {
        list($dia, $mes, $ano) = explode("/", $fecha);
        return "$ano-$mes-$dia";
    }

    function cambiarfecha_espaniol($fecha) {
        list($ano, $mes, $dia) = explode("-", $fecha);
        return "$dia/$mes/$ano";
    }

    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    function stringToColorCode($str) {
        $code = dechex(crc32($str));
        $code = substr($code, 0, 6);
        return $code;
    }

}
