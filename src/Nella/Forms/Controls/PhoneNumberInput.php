<?php
/**
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms\Controls;

use Nette\Utils\Strings;
use Nette\Forms\Form;

/**
 * Phone number form control
 *
 * @author        Patrik Votoček
 *
 * @property string $value
 */
class PhoneNumberInput extends \Nette\Forms\Controls\BaseControl
{
	/** @var string */
	const NAME_PREFIX = 'prefix';
	/** @var string */
	const NAME_NUMBER = 'number';

	/** @var array */
	private static $phonePrefixes = array(
		'+1',
		'+20',
		'+27',
		'+28',
		'+210',
		'+211',
		'+212',
		'+213',
		'+214',
		'+215',
		'+216',
		'+217',
		'+218',
		'+219',
		'+220',
		'+221',
		'+222',
		'+223',
		'+224',
		'+225',
		'+226',
		'+227',
		'+228',
		'+229',
		'+230',
		'+231',
		'+232',
		'+233',
		'+234',
		'+235',
		'+236',
		'+237',
		'+238',
		'+239',
		'+240',
		'+241',
		'+242',
		'+243',
		'+244',
		'+245',
		'+246',
		'+247',
		'+248',
		'+249',
		'+250',
		'+251',
		'+252',
		'+253',
		'+254',
		'+255',
		'+256',
		'+257',
		'+258',
		'+259',
		'+260',
		'+261',
		'+262',
		'+263',
		'+264',
		'+265',
		'+266',
		'+267',
		'+268',
		'+269',
		'+290',
		'+291',
		'+292',
		'+293',
		'+294',
		'+295',
		'+296',
		'+297',
		'+298',
		'+299',
		'+30',
		'+31',
		'+32',
		'+33',
		'+34',
		'+36',
		'+39',
		'+350',
		'+351',
		'+352',
		'+353',
		'+354',
		'+355',
		'+356',
		'+357',
		'+358',
		'+359',
		'+370',
		'+371',
		'+372',
		'+373',
		'+374',
		'+375',
		'+376',
		'+377',
		'+378',
		'+379',
		'+380',
		'+381',
		'+382',
		'+383',
		'+384',
		'+385',
		'+386',
		'+387',
		'+388',
		'+389',
		'+40',
		'+41',
		'+43',
		'+44',
		'+45',
		'+46',
		'+47',
		'+48',
		'+49',
		'+420',
		'+421',
		'+422',
		'+423',
		'+424',
		'+425',
		'+426',
		'+427',
		'+428',
		'+429',
		'+51',
		'+52',
		'+53',
		'+54',
		'+55',
		'+56',
		'+57',
		'+58',
		'+500',
		'+501',
		'+502',
		'+503',
		'+504',
		'+505',
		'+506',
		'+507',
		'+508',
		'+509',
		'+590',
		'+591',
		'+592',
		'+593',
		'+594',
		'+595',
		'+596',
		'+597',
		'+598',
		'+599',
		'+60',
		'+61',
		'+62',
		'+63',
		'+64',
		'+65',
		'+66',
		'+670',
		'+671',
		'+672',
		'+673',
		'+674',
		'+675',
		'+676',
		'+677',
		'+678',
		'+679',
		'+680',
		'+681',
		'+682',
		'+683',
		'+684',
		'+685',
		'+686',
		'+687',
		'+688',
		'+689',
		'+690',
		'+691',
		'+692',
		'+693',
		'+694',
		'+695',
		'+696',
		'+697',
		'+698',
		'+699',
		'+7',
		'+800',
		'+801',
		'+802',
		'+803',
		'+804',
		'+805',
		'+806',
		'+807',
		'+808',
		'+809',
		'+81',
		'+82',
		'+83',
		'+84',
		'+86',
		'+89',
		'+850',
		'+851',
		'+852',
		'+853',
		'+854',
		'+855',
		'+856',
		'+857',
		'+858',
		'+859',
		'+870',
		'+875',
		'+876',
		'+877',
		'+878',
		'+879',
		'+880',
		'+881',
		'+882',
		'+883',
		'+884',
		'+885',
		'+886',
		'+887',
		'+888',
		'+889',
		'+90',
		'+91',
		'+92',
		'+93',
		'+94',
		'+95',
		'+98',
		'+960',
		'+961',
		'+962',
		'+963',
		'+964',
		'+965',
		'+966',
		'+967',
		'+968',
		'+969',
		'+970',
		'+971',
		'+972',
		'+973',
		'+974',
		'+975',
		'+976',
		'+977',
		'+978',
		'+979',
		'+990',
		'+991',
		'+992',
		'+993',
		'+994',
		'+995',
		'+996',
		'+997',
		'+998',
		'+999',
	);

	/** @var bool */
	private static $registered = false;

	/** @var string */
	private $prefix;
	/** @var string */
	private $number;

	/**
	 * @param string
	 * @return PhoneNumberInput
	 * @throws \Nette\InvalidArgumentException
	 */
	public function setValue($value)
	{
		if ($value === NULL) {
			$this->prefix = NULL;
			$this->number = NULL;
			return $this;
		}

		$value = $this->normalizePhoneNumber($value);

		if (!$this->validatePhoneNumberString($value)) {
			throw new \Nette\InvalidArgumentException('Value must starts with + and numbers, "' . $value . '" given.');
		}

		$data = Strings::match($value, $this->getPattern());

		if (!isset($data[static::NAME_PREFIX]) || !isset($data[static::NAME_NUMBER])) {
			throw new \Nette\InvalidArgumentException('Value must starts with + and numbers, "' . $value . '" given.');
		}

		$this->prefix = $data[static::NAME_PREFIX];
		$this->number = $data[static::NAME_NUMBER];

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getValue()
	{
		if (empty($this->prefix) || empty($this->prefix)) {
			return NULL;
		}
		$value = $this->normalizePhoneNumber($this->prefix . $this->number);

		if (!$this->validatePhoneNumberString($value)) {
			return NULL;
		}

		return $value;
	}

	/**
	 * @return bool
	 */
	public function isFilled()
	{
		return !empty($this->number);
	}

	public function loadHttpData()
	{
		$this->prefix = $this->getHttpData(Form::DATA_LINE, '[' . static::NAME_PREFIX . ']');
		$this->number = $this->getHttpData(Form::DATA_LINE, '[' . static::NAME_NUMBER . ']');
	}

	public function getControl()
	{
		return $this->getControlPart(static::NAME_PREFIX) . $this->getControlPart(static::NAME_NUMBER);
	}

	/**
	 * @param string
	 * @return \Nette\Utils\Html
	 * @throws \Nette\InvalidArgumentException
	 */
	public function getControlPart($key)
	{
		$name = $this->getHtmlName();

		if ($key === static::NAME_PREFIX) {
			$control = \Nette\Forms\Helpers::createSelectBox(
				array_combine(static::$phonePrefixes, static::$phonePrefixes),
				array(
					'selected?' => $this->prefix,
				)
			);
			$control->name($name . '[' . static::NAME_PREFIX . ']')->id($this->getHtmlId());

			if ($this->disabled) {
				$control->disabled($this->disabled);
			}

			return $control;
		} elseif ($key === static::NAME_NUMBER) {
			$control = \Nette\Utils\Html::el('input')->name($name . '[' . static::NAME_NUMBER . ']');
			$control->value($this->number);

			if ($this->disabled) {
				$control->disabled($this->disabled);
			}

			return $control;
		}

		throw new \Nette\InvalidArgumentException('Part ' . $key . ' does not exist');
	}

	public function getLabelPart()
	{
		return NULL;
	}

	/**
	 * @param \Nette\Forms\IControl
	 * @return bool
	 */
	public function validatePhoneNumber(\Nette\Forms\IControl $control)
	{
		$value = $control->getHttpData(Form::DATA_LINE, '[' . static::NAME_PREFIX . ']');
		$value .= $control->getHttpData(Form::DATA_LINE, '[' . static::NAME_NUMBER . ']');
		return $this->validatePhoneNumberString($value);
	}

	/**
	 * @param string
	 * @return bool
	 */
	private function validatePhoneNumberString($value)
	{
		$value = $this->normalizePhoneNumber($value);
		return (bool) Strings::match($value, $this->getPattern());
	}

	/**
	 * @return string
	 */
	private function getPattern()
	{
		return '~^(?P<' . static::NAME_PREFIX . '>\\' . implode('|\\', static::$phonePrefixes) . ')(?P<' . static::NAME_NUMBER . '>\d{6,15})$~';
	}

	/**
	 * @param string
	 * @return string
	 */
	private function normalizePhoneNumber($value)
	{
		$value = Strings::replace($value, array(
			'~(\s+|\.|-)~' => '', // remove separators
			'~^00(\d{10,16})$~' => '+$1$2',
			'~^(\d{9,18})$~' => '+$1$2', // missing +
		));

		return $value;
	}

	public static function register()
	{
		if (static::$registered) {
			throw new \Nette\InvalidStateException('PhoneNumber control already registered.');
		}

		static::$registered = true;

		$class = get_called_class();
		$callback = function (\Nette\Forms\Container $_this, $name, $label = NULL) use ($class) {
			$control = new $class($label);
			$_this->addComponent($control, $name);
			return $control;
		};

		\Nette\Forms\Container::extensionMethod('addPhone', $callback);
	}
}
