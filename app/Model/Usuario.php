<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Usuario Model
 *
 * @property Rol $Rol
 * @property Reserva $Reserva
 */
class Usuario extends AppModel {

    public $useTable = 'usuarios';
    public $primaryKey = 'id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'apellido';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Debe ingresar un email válido',
                'allowEmpty' => false,
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Este campo no puede estar vacío',
            ),
            'unique' => array(
                'rule' => array('isUniqueEmail'),
                'message' => 'Este email ya esta en uso',
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Debe ingresar la contraseña'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'La contraseña debe tener al menos 6 carácteres'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Debe ingresar la contraseña'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'Ambos campos de contraseña deben coincidir'
            )
        ),
        'nombre' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 32),
                'message' => 'Your custom message here',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Por favor complete este campo',
            ),
        ),
        'apellido' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 32),
                'message' => 'Your custom message here',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Por favor complete este campo',
            ),
        ),
        'rol_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Por favor complete este campo',
            ),
        ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Rol' => array(
            'className' => 'Rol',
            'foreignKey' => 'rol_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Reserva' => array(
            'className' => 'Reserva',
            'foreignKey' => 'usuario_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    /* function isUniqueUsername($check) {

      $username = $this->find(
      'first', array(
      'fields' => array(
      'User.id',
      'User.username'
      ),
      'conditions' => array(
      'User.username' => $check['username']
      )
      )
      );

      if (!empty($username)) {
      if ($this->data[$this->alias]['id'] == $username['User']['id']) {
      return true;
      } else {
      return false;
      }
      } else {
      return true;
      }
      } */

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {

        $email = $this->find(
                'first', array(
            'fields' => array(
                'Usuario.id'
            ),
            'conditions' => array(
                'Usuario.email' => $check['email']
            )
                )
        );

        if (!empty($email)) {
            if ($this->data[$this->alias]['id'] == $email['Usuario']['id']) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equaltofield($check, $otherfield) {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }

    /* public function beforeSave($options = array()) {
      if (isset($this->data[$this->alias]['password'])) {
      $passwordHasher = new BlowfishPasswordHasher();
      $this->data[$this->alias]['password'] = $passwordHasher->hash(
      $this->data[$this->alias]['password']
      );
      }
      return true;
      } */
}
