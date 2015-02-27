<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PerfilController
 * @author lucho
 */
class PerfilesController extends AppController {

    public function edit() {

        $this->loadModel('Usuario');

        $usuario = $this->Usuario->findById(AuthComponent::user('id'));

        if (!$usuario) {
            $this->Session->setFlash('Identificador de usuario inválido', 'flash_danger');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Usuario->id = $id;
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido actualizado'), 'flash_success');
                $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('No se ha podido actualizar el usuario.'), 'flash_danger');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $usuario;
        }
    }

}
