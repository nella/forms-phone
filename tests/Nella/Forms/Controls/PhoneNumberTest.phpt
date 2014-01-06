<?php
/**
 * Test: Nella\Forms\Controls\PhoneNumber
 * @testCase
 *
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) 2006, 2012 Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms\Controls;

use Tester\Assert;

$container = require __DIR__ . '/../../../bootstrap.php';

/**
 * Phone number form control
 *
 * @author        Patrik Votoček
 */
class PhoneNumberTest extends \Tester\TestCase
{
	/**
	 * @return array[]|array
	 */
	public function dataValidPhoneNumbers()
	{
		return array(
			array(NULL, NULL),
			array('+1-800-692-7753', '+18006927753'),
			array('+420234567890', '+420234567890'),
			array('+420 234 567 890', '+420234567890'),
			array('+420.234.567.890', '+420234567890'),
			array('+420-234-567-890', '+420234567890'),
			array('00420234567890', '+420234567890'),
			array('420234567890', '+420234567890'),
			array(420234567890, '+420234567890'),
		);
	}

	/**
	 * @return array[]|array
	 */
	public function dataInvalidPhoneNumbers()
	{
		return array(
			array('foo'),
			array('123'),
			array(123),
			array('+1@800@692@7753'),
		);
	}

	/**
	 * @dataProvider dataValidPhoneNumbers
	 *
	 * @param string
	 * @param string
	 */
	public function testValidPhoneNumbers($input, $expected)
	{
		$control = new PhoneNumber;

		$control->setValue($input);

		Assert::equal($expected, $control->getValue());
	}

	/**
	 * @dataProvider dataInvalidPhoneNumbers
	 *
	 * @param string
	 */
	public function testInvalidPhoneNumbers($input)
	{
		$control = new PhoneNumber;

		Assert::exception(function() use($control, $input) {
			$control->setValue($input);
		}, 'Nette\InvalidArgumentException');
	}

	public function testHtmlPartNumber()
	{
		$form = new \Nette\Forms\Form;
		$control = new PhoneNumber;
		$form->addComponent($control, 'phone');
		$control->setValue('420234567890');

		$dq = \Tester\DomQuery::fromHtml((string) $control->getControlPart('number'));

		Assert::true($dq->has("input[value=234567890]"));
	}

	public function testHtmlPartPrefix()
	{
		$form = new \Nette\Forms\Form;
		$control = new PhoneNumber;
		$form->addComponent($control, 'phone');
		$control->setValue('420234567890');

		$dq = \Tester\DomQuery::fromHtml((string) $control->getControlPart('prefix'));

		Assert::true($dq->has('select option[value=+420][selected]'));
	}

	public function testHtml()
	{
		$form = new \Nette\Forms\Form;
		$control = new PhoneNumber;
		$form->addComponent($control, 'phone');
		$control->setValue('420234567890');

		$dq = \Tester\DomQuery::fromHtml((string) $control->getControl());

		Assert::true($dq->has("input[value=234567890]"));
		Assert::true($dq->has('select option[value=+420][selected]'));
	}

	public function testLoadHttpDataEmpty()
	{
		$control = $this->createControl();

		Assert::false($control->isFilled());
		Assert::null($control->getValue());
	}

	public function testLoadHttpDataValid()
	{
		$control = $this->createControl(array(
			'phone' => array('prefix' => '+420', 'number' => '234567890'),
		));

		Assert::equal('+420234567890', $control->getValue());
	}

	public function testLoadHttpDataInvalid()
	{
		$control = $this->createControl(array(
			'phone' => array('prefix' => NULL, 'number' => '123'),
		));

		Assert::true($control->isFilled());
		Assert::null($control->getValue());
	}

	public function testValidatePhoneNumberValid()
	{
		$control = $this->createControl(array(
			'phone' => array('prefix' => '+420', 'number' => '234567890'),
		));

		Assert::true($control->validatePhoneNumber($control));
	}

	public function testValidatePhoneNumberInvalid()
	{
		$control = $this->createControl(array(
			'phone' => array('prefix' => NULL, 'number' => '123'),
		));

		Assert::false($control->validatePhoneNumber($control));
	}

	private function createControl($data = array())
	{
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_FILES = array();
		$_POST = $data;

		$form = new \Nette\Forms\Form;
		$control = new PhoneNumber;
		$form->addComponent($control, 'phone');

		return $control;
	}
}

id(new PhoneNumberTest)->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
