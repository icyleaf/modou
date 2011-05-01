<?php defined('SYSPATH') or die('No direct script access.');

class Model_User_Agent extends Sprig {

	protected function _init()
    {
        $this->_fields += array(
            'id' => new Sprig_Field_Auto,
            'people_id' => new Sprig_Field_Integer,
            'browser' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
            'version' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
			'platform' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
			'is_mobile' => new Sprig_Field_Integer(array(
				'empty' => TRUE,
			)),
            'ua' => new Sprig_Field_Text(array(
				'empty' => TRUE,
			)),
            'date' => new Sprig_Field_Timestamp(array(
				'format' => 'date',
				'auto_now_create' => TRUE,
			)),
        );
    }

}

