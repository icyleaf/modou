<?php defined('SYSPATH') or die('No direct script access.');

class Model_People extends Sprig {

	protected function _init()
	{
		$this->_fields += array(
			// Fields
			'id' => new Sprig_Field_Auto,
			'douban_id' => new Sprig_Field_Integer(array(
				'empty' => TRUE,
			)),
            'username' => new Sprig_Field_Char,
            'location' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
            'homepage' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
            'created' => new Sprig_Field_Timestamp(array(
				'format' => 'date',
				'auto_now_create' => TRUE,
			)),
			'logins' => new Sprig_Field_Integer(array(
				'empty' => TRUE,
			)),
			'last_login' => new Sprig_Field_Timestamp(array(
				'format' => 'date',
				'auto_now_update' => TRUE,
			)),
			// Relationships
			'feedback' => new Sprig_Field_HasMany(array(
				'model' => 'feedback',
			)),
		);
	}

}

