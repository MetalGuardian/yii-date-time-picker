Yii CJuiDateTimePicker
=======================

Based on [Anatoly Ivanchin](http://anatoliyivanchin.moikrug.ru/) [extension](http://www.yiiframework.com/extension/datetimepicker/),
which used [jQuery Timepicker Addon](https://github.com/trentrichardson/jQuery-Timepicker-Addon).

Full addon documentation: [http://trentrichardson.com/examples/timepicker/](http://trentrichardson.com/examples/timepicker/)

Updated by [me](https://github.com/MetalGuardian)

	$this->widget(
		\yiiDateTimePicker\CJuiDateTimePicker::className(),
		array(
			'model' => $news, // model object
			'attribute' => 'eventDate', // attribute name
			'mode' => 'datetime' // use "time","date" or "datetime" (default)
			'options' => array(), // jquery plugin options
		)
	);
