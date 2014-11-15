Phone number control for [Nette Framework](http://nette.org)
=============================================================================================

[![Build Status](https://travis-ci.org/nella/forms-phone.svg?branch=master)](https://travis-ci.org/nella/forms-phone)
[![SensioLabsInsight Status](https://insight.sensiolabs.com/projects/87599011-10dd-427c-946a-5383f88f5d8d/mini.png)](https://insight.sensiolabs.com/projects/87599011-10dd-427c-946a-5383f88f5d8d)
[![Latest Stable Version](https://poser.pugx.org/nella/forms-phone/version.png)](https://packagist.org/packages/nella/forms-phone)
[![Composer Downloads](https://poser.pugx.org/nella/forms-phone/d/total.png)](https://packagist.org/packages/nella/forms-phone)
[![Dependency Status](https://www.versioneye.com/user/projects/5467a452f8a4ae213300026e/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5467a452f8a4ae213300026e)
[![HHVM Status](http://hhvm.h4cc.de/badge/nella/forms-phone.svg)](http://hhvm.h4cc.de/package/nella/forms-phone)

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
