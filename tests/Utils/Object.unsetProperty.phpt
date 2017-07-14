<?php

/**
 * Test: Nette\Object properties.
 * @phpVersion < 7.2
 */

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


class TestClass extends Nette\Object
{
	public $foo;
}


test(function () {
	$obj = new TestClass;
	unset($obj->foo);
	Assert::false(isset($obj->foo));

	// re-set
	$obj->foo = 'hello';
	Assert::same('hello', $obj->foo);
});


test(function () {
	// double unset
	$obj = new TestClass;
	unset($obj->foo, $obj->foo);
});


test(function () {
	// reading of unset property
	Assert::exception(function () {
		$obj = new TestClass;
		unset($obj->foo);
		$val = $obj->foo;
	}, Nette\MemberAccessException::class, 'Cannot read an undeclared property TestClass::$foo.');
});
