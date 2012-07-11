<?php
class SendShell extends AppShell {
  public $uses = array('EmailQueue.Email');

  public function main() {
    $limit = $this->params['limit'];
    $conditions = array('Email.send' => null);

    $emails = $this->Email->find('all', compact('conditions', 'limit'));

    if ($emails) {
      foreach ($emails as $id => $email) {
        if (!$email->send()) {
          unset($emails[$id]);
        }
      }

      $this->Email->updateAll(
        array('send' => '"'.date('Y-m-d H:i:s').'"'),
        array('Email.id' => array_keys($emails))
      );
      $this->out(sprintf('%d emails send', count($emails)));
    } else {
      $this->out('No emails send');
    }

  }

  public function getOptionParser() {
    $parser = parent::getOptionParser();
    $parser->addOption('limit', array(
      'help' => 'Limit how many emails should be send on one cronjob iteration.',
      'short' => 'l',
      'default' => 10,
    ));
    return $parser;
  }

  public function help() {
    $this->out('Add this command to your crontab to send emails added to queue.');
  }
}