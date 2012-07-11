<?php
class Email extends AppModel {
  public $name = 'Email';

  private function cakeEmailToParams($email, $defaults) {
    App::uses('CakeEmail', 'Network/Email');
    $result = array();

    $result['to'] = join(',', $email->to());
    $result['subject'] = $email->subject();
    $result = array_merge($result, $email->template());
    $result['vars'] = serialize($email->viewVars());

    return $result;
  }

  private function paramsToCakeEmail($params) {
    $result = new CakeEmail('default');
    $result
      ->to($params['to'])
      ->subject($params['subject'])
      ->template($params['template'], $params['layout'])
      ->viewVars(unserialize($params['vars']));

    return $result;
  }

  public function set($one, $two = null) {
    if (is_object($one) && $one instanceof CakeEmail) {
      $defaults = $this->data[$this->name];
      $this->data[$this->name] = array();
      $one = $this->cakeEmailToParams($one, $defaults);
    }
    return parent::set($one, $two);
  }

  public function find($type = 'first', $query = array()) {
    $data = parent::find($type, $query);

    if (!empty($data)) {
      if (!Set::numeric(array_keys($data))) {
        $data = array($data);
      }

      App::uses('CakeEmail', 'Network/Email');

      foreach ($data as $d){
        $result[$d['Email']['id']] = $this->paramsToCakeEmail($d['Email']);
      }

      return $result;
    }
    return false;
  }

}