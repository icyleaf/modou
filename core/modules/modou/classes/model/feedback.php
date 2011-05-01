<?php defined('SYSPATH') or die('No direct script access.');

class Model_Feedback extends Sprig {

	protected function _init()
    {
        $this->_fields += array(
			// Fields
            'id' => new Sprig_Field_Auto,
            'message' => new Sprig_Field_Text,
            'type' => new Sprig_Field_Char(array(
				'empty' => TRUE,
			)),
            'ua' => new Sprig_Field_Text(array(
				'empty' => TRUE,
			)),
            'created' => new Sprig_Field_Timestamp(array(
				'format' => 'date',
				'auto_now_create' => TRUE,
			)),
			// Relationships
			'people' => new Sprig_Field_BelongsTo(array(
                'model' => 'people',
            )),
        );
    }

}

