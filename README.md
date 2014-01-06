Phone number control for [Nette Framework](http://nette.org)
=============================================================================================

Installation
------------

```
composer require nella/forms-phone
```

Usage
------

```php

$form = new \Nette\Forms\Form;
$form->addComponent(new \Nella\Forms\Controls\PhoneNumber('Phone'), 'phone');

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
