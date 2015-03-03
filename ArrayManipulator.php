<?php
/**
 * ArrayManipulator
 *
 * This is just a simple php class to validate an array and avoid
 * the ternaries validations making a clear and easy code
 *
 * PHP Version 5.3
 *
 * @author   Francisco Gonzalez <fgonzalez@artedigitalstudio.com>
 * @license  ArteDigital Studio
 * @link     http://www.artedigitalstudio.com
 */

namespace AD;

/**
 * ArrayManipulator Class
 *
 * PHP Version 5.3
 *
 * @author   Francisco Gonzalez <fgonzalez@artedigitalstudio.com>
 * @license  ArteDigital Studio
 * @link     http://www.artedigitalstudio.com
 */
class ArrayManipulator
{
	const ARRAY_ISSET = 1;
	const ARRAY_EMPTY = 2;

	protected $array_value     = array();
	protected $validation_type = self::ARRAY_ISSET;

	public function __construct($array_value = array())
	{
		$this->setArray($array_value);
	}

	/**
	 * Set the array to be manipulated
	 *
	 * @param array $array_value The array to be manipulated
	 *
	 * @return  AD\ArrayManipulator
	 */
	public function setArray($array_value)
	{
		$this->array_value = $array_value;

		return $this;
	}

	/**
	 * Returnt the original array
	 *
	 * @return array
	 */
	public function getArray()
	{
		return $this->array_value;
	}

	/**
	 * Return the current valiadtion type to be used
	 *
	 * @return integer
	 */
	public function getCurrentValidationType()
	{
		return $this->validation_type;
	}

	/**
	 * Set the validation type to be used by the class,
	 *
	 * @param integer $validation_type The validation type to be used (ARRAY_ISSET | ARRAY_EMPTY)
	 *
	 * @return  AD\ArrayManipulator
	 */
	public function setValidationType($validation_type = null)
	{
		if (null !== $validation_type) {
			$this->validation_type = $validation_type;
		}

		return $this;
	}

	/**
	 * Get the value of the requested index from the array,
	 * if is not empty or exists, in the other hand
	 * return the default value
	 *
	 * @param mixed   $index           The index to be check
	 * @param mixed   $default_value   The default value to return
	 * @param integer $validation_type The validation type to use
	 *
	 * @return mixed The result
	 */
	public function get($index, $default_value = null, $validation_type = null)
	{
		$this->setValidationType($validation_type);

		switch ($this->validation_type) {
			case self::ARRAY_ISSET:
				$default_value = $this->getIsSet($index, $default_value);
				break;
			case self::ARRAY_EMPTY:
			default:
				$default_value = $this->getNotEmpty($index, $default_value);
				break;
		}

		return $default_value;
	}

	/**
	 * Validate if the index is not empty and return the value,
	 * if is empty return the default
	 *
	 * @param mixed $index   The index to be checked
	 * @param mixed $default_value The default value to return
	 *
	 * @return mixed The result value
	 */
	protected function getNotEmpty($index, $default_value = '')
	{
		if (!empty($this->array_value[$index])) {
			$default_value = $this->array_value[$index];
		}

		return $default_value;
	}

	/**
	 * Validate if the index is set and return the value,
	 * if not set return the default
	 *
	 * @param mixed $index   The index to be checked
	 * @param mixed $default_value The default value to return
	 *
	 * @return mixed The result value
	 */
	protected function getIsSet($index, $default_value = '')
	{
		if (isset($this->array_value[$index])) {
			$default_value = $this->array_value[$index];
		}

		return $default_value;
	}
}