<?php
class EmailQueueSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $emails = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'to' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'subject' => array('type' => 'string', 'null' => false, 'default' => 'Sellbox', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
    'layout' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'template' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'vars' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'send' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
}
