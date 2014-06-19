Phone number control for [Nette Framework](http://nette.org)
=============================================================================================

[![Latest Stable Version](https://poser.pugx.org/nella/forms-phone/v/stable.png)](https://packagist.org/packages/nella/forms-phone) | [![Build Status](https://travis-ci.org/nella/forms-phone.png?branch=master)](https://travis-ci.org/nella/forms-phone)

Installation
------------

```
composer require nella/forms-phone
```

Usage
------

```php

$form = new \Nette\Forms\Form;
$form->addComponent(new \Nella\Forms\Controls\PhoneNumberInput('Phone'), 'phone');

// or

\Nella\Forms\Controls\PhoneNumberInput::register();
$form->addPhone('phone', 'Phone');

// Optional phone numnber validation
$form['phone']
	->addCondition(\Nette\Application\UI\Form::FILLED)
		->addRule([$form['phone'], 'validatePhoneNumber'], 'Phone number is invalid');

```

Manual rendering
----------------

```smarty
{form myForm}
	{label phone /}
	{input phone:prefix}
	{input phone:number}
{/form}
```

License
-------
Phone number control for Nette Framework is licensed under the MIT License - see the LICENSE file for details
