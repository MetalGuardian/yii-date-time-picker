Yii CJuiDateTimePicker
=======================

Yii datetime picker. Used [jQuery Timepicker Addon](https://github.com/trentrichardson/jQuery-Timepicker-Addon).

Full datetime picker documentation: [http://trentrichardson.com/examples/timepicker/](http://trentrichardson.com/examples/timepicker/)

	$this->widget(
		\yiiDateTimePicker\CJuiDateTimePicker::className(),
		array(
			'model' => $news, // model object
			'attribute' => 'eventDate', // attribute name
			'mode' => 'datetime' // use "time","date" or "datetime" (default)
			'options' => array(), // jquery plugin options
		)
	);
