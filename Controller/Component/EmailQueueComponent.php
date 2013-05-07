<?php

class EmailQueueComponent extends Component {
  private $controller;

  public function initialize(Controller $controller) {
    $this->controller = $controller;
  }

  public function add($email) {

    $this->controller->loadModel('EmailQueue.Email');
    $this->controller->Email->create($email);
    if ($this->controller->Email->save()) {
      return true;
    }
    $this->log(json_encode(array(
      $email,
      $this->controller->Email->validationErrors
    )), 'email-queue');

    return false;
  }


}