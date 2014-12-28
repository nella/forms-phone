Phone number control for [Nette Framework](http://nette.org)
=============================================================================================

[![Build Status](https://img.shields.io/travis/nella/forms-phone.svg?style=flat-square)](https://travis-ci.org/nella/forms-phone)
[![SensioLabsInsight Status](https://img.shields.io/sensiolabs/i/87599011-10dd-427c-946a-5383f88f5d8d.svg?style=flat-square)](https://insight.sensiolabs.com/projects/87599011-10dd-427c-946a-5383f88f5d8d)
[![Latest Stable Version](https://img.shields.io/packagist/v/nella/forms-phone.svg?style=flat-square)](https://packagist.org/packages/nella/forms-phone)
[![Composer Downloads](https://img.shields.io/packagist/dt/nella/forms-phone.svg?style=flat-square)](https://packagist.org/packages/nella/forms-phone)
[![Dependency Status](https://img.shields.io/versioneye/d/user/projects/5467a452f8a4ae213300026e.svg?style=flat-square)](https://www.versioneye.com/user/projects/5467a452f8a4ae213300026e)
[![HHVM Status](https://img.shields.io/hhvm/nella/forms-phone.svg?style=flat-square)](http://hhvm.h4cc.de/package/nella/forms-phone)

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
