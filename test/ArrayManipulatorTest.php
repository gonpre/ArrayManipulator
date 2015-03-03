<?php
require_once __DIR__ . '/../ArrayManipulator.php';

class ArrayManipulatorTest extends PHPUnit_Framework_TestCase
{
	protected $array_manipulator;
	protected $original_array = [
		'correct_value'        => 'something',
		'validate_empty_index' => '',
	];

	public function setUp()
	{
		$this->array_manipulator = new \AD\ArrayManipulator($this->original_array);
	}

	public function testNewReturnArrayManipulatorObject()
	{
		$this->assertInstanceOf(
			'\AD\ArrayManipulator',
			$this->array_manipulator
		);
	}

	public function testGetCurrentValidationTypeShouoldReturnIssetType()
	{
		$expected = \AD\ArrayManipulator::ARRAY_ISSET;

		$this->assertEquals($expected, $this->array_manipulator->getCurrentValidationType());
	}

	public function testIfChangedValidationTypeGetCurrentValidationTypeShouoldReturnCorrectType()
	{
		$expected = \AD\ArrayManipulator::ARRAY_EMPTY;

		$this->array_manipulator->setValidationType($expected);

		$this->assertEquals($expected, $this->array_manipulator->getCurrentValidationType());
	}

	public function testGetWithIssetValidationShouldReturnValue()
	{
		$expected      = 'something';
		$default_value = 'default value';

		$this->assertEquals(
			$expected,
			$this->array_manipulator->get(
				'correct_value',
				$default_value
			)
		);
	}

	public function testGetWithIssetValidationShouldReturnDefaultValue()
	{
		$expected = 'this is the default value';

		$this->assertEquals(
			$expected,
			$this->array_manipulator->get(
				'missing_index',
				$expected
			)
		);
	}

	public function testGetWithEmptyValidationShouldReturnValue()
	{
		$expected      = 'something';
		$default_value = 'default value';

		$this->assertEquals(
			$expected,
			$this->array_manipulator->get(
				'correct_value',
				$default_value,
				\AD\ArrayManipulator::ARRAY_EMPTY
			)
		);
	}

	public function testGetWithEmptyValidationShouldReturnDefaultValue()
	{
		$expected = 'this is the default value';

		$this->assertEquals(
			$expected,
			$this->array_manipulator->get(
				'validate_empty_index',
				$expected,
				\AD\ArrayManipulator::ARRAY_EMPTY
			)
		);
	}

	public function testGetArrayShouldReturnTheOriginalArray()
	{
		$expected = $this->original_array;

		$this->assertEquals($expected, $this->array_manipulator->getArray());
	}
}