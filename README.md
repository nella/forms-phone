Phone number control for [Nette Framework](http://nette.org)
=============================================================================================

[![Build Status](https://travis-ci.org/nella/forms-phone.svg?branch=nette)](https://travis-ci.org/nella/forms-phone)
[![Latest Stable Version](https://poser.pugx.org/nella/forms-phone/version.png)](https://packagist.org/packages/nella/forms-phone)
[![Composer Downloads](https://poser.pugx.org/nella/forms-phone/d/total.png)](https://packagist.org/packages/nella/forms-phone)
[![Dependency Status](https://www.versioneye.com/user/projects/534bc4e7fe0d0774a80000f4/badge.svg?style=flat)](https://www.versioneye.com/user/projects/534bc4e7fe0d0774a80000f4)

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

// Optional phone number validation
$form['phone']
	->addCondition(\Nette\Application\UI\Form::FILLED)
		->addRule([$form['phone'], 'validatePhoneNumber'], 'Phone number is invalid');
		
// Optional phone number default prefix
$control = $form->addPhone('phone', 'Phone');
$control->setDefaultPrefix('+420');
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
