<?php
/**
 * CJuiDateTimePicker class file.
 *
 * @author Anatoly Ivanchin <van4in@gmail.com>
 */

namespace yiiDateTimePicker;

\Yii::import('zii.widgets.jui.CJuiDatePicker');

/**
 * Class CJuiDateTimePicker
 */
class CJuiDateTimePicker extends \CJuiDatePicker
{
	/**
	 * Widget mode: date, time, datetime (default)
	 *
	 * @var string
	 */
	public $mode = 'datetime';

	/**
	 * Use original yii jquery-ui-i18n.min.js
	 *
	 * @var bool
	 */
	public $useDefaultLocalization = true;

	public function init()
	{
		if (!in_array($this->mode, array('date', 'time', 'datetime'), true)) {
			throw new \CException('unknown mode "' . $this->mode . '"');
		}
		if (!isset($this->language)) {
			$this->language = \Yii::app()->getLanguage();
		}
		parent::init();
	}

	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		if (isset($this->htmlOptions['id'])) {
			$id = $this->htmlOptions['id'];
		} else {
			$this->htmlOptions['id'] = $id;
		}

		if (isset($this->htmlOptions['name'])) {
			$name = $this->htmlOptions['name'];
		} else {
			$this->htmlOptions['name'] = $name;
		}

		if ($this->hasModel()) {
			echo \CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
		} else {
			echo \CHtml::textField($name, $this->value, $this->htmlOptions);
		}
		$options = \CJavaScript::encode($this->options);
		$js = "jQuery('#{$id}').{$this->mode}picker($options);";
		$cs = \Yii::app()->getClientScript();
		$assets = \Yii::app()->getAssetManager()->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets');
		if (YII_DEBUG) {
			$cs->registerCssFile($assets . '/jquery-ui-timepicker-addon.css');
			$cs->registerScriptFile($assets . '/jquery-ui-timepicker-addon.js', \CClientScript::POS_END);
			$cs->registerScriptFile($assets . '/jquery-ui-sliderAccess.js', \CClientScript::POS_END);
			$cs->registerScriptFile($assets . '/i18n/jquery-ui-timepicker-addon-i18n.js', \CClientScript::POS_END);
		} else {
			$cs->registerCssFile($assets . '/jquery-ui-timepicker-addon.min.css');
			$cs->registerScriptFile($assets . '/jquery-ui-timepicker-addon.min.js', \CClientScript::POS_END);
			$cs->registerScriptFile($assets . '/jquery-ui-sliderAccess.min.js', \CClientScript::POS_END);
			$cs->registerScriptFile($assets . '/i18n/jquery-ui-timepicker-addon-i18n.min.js', \CClientScript::POS_END);
		}

		if (isset($this->language)) {
			if ($this->useDefaultLocalization) {
				$this->registerScriptFile($this->i18nScriptFile);
			}
			$js =
<<<EOD
jQuery('#{$id}').{$this->mode}picker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['{$this->language}'], jQuery.timepicker.regional['{$this->language}'], {$options}));
EOD;
		}
		$cs->registerScript(
			__CLASS__,
			$this->defaultOptions
				?
				'jQuery.{$this->mode}picker.setDefaults(' . \CJavaScript::encode($this->defaultOptions) . ');'
				:
				''
		);
		$cs->registerScript(__CLASS__ . '#' . $id, $js);
	}

	/**
	 * Return extension full class name
	 *
	 * @return string
	 */
	public static function className()
	{
		return get_called_class();
	}
}
