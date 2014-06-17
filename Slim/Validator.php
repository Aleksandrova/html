<?php
/**
 * Class Validation
 *
 * @package AlbaFramework
 * @author Deepsy ( deepsybg@gmail.com )
 * @location /core
*/

class Validation
{
	public function add($var)
	{
		return new Validate($var);
	}

	public function compare($with = false, $message = 'Error occurred!')
	{
		if ( $with )
			throw new ValidationException($message);
	}

	public function isIndex($var, $index, $message = 'Input not set.')
	{
		if ( !isset($var[$index]) )
			throw new ValidationException($message);
		return new Validate($var);
	}
}

class Validate
{
	public $success = false;
	private $value, $label;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function isEmail($message = 'Invalid Email.')
	{
		if ( !preg_match( '/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/', $this->value ) ) 
			throw new ValidationException($message, 0);
		return $this;
	}

	public function mixed($message = 'Only chars and digits are allowed.')
	{
		if ( !preg_match("/^[a-zA-Z0-9]+$/", $this->value) )
			throw new ValidationException($message, 1);
		return $this;
	}

	public function min($min, $message = 'Input too short.')
	{
		if ( strlen($this->value) < $min )
			throw new ValidationException($message, 2);
		return $this;
	}

	public function max($max, $message = 'Input too long.')
	{
		if ( strlen($this->value) > $max )
			throw new ValidationException($message, 3);
		return $this;
	}

	public function equalTo($equalValue, $message = 'The value isnt equal.')
	{
		if ( $this->value != $equalValue )
			throw new ValidationException($message, 4);
		return $this;
	}

	public function notEqualTo($equalValue, $message = 'The value isnt equal.')
	{
		if ( $this->value == $equalValue )
			throw new ValidationException($message,4);
		return $this;
	}

	public function notNull($message = 'Empty value')
	{
		if ( !(!empty($this->value) || isset($this->value)) )
			throw new ValidationException($message, 5);
		return $this;
	}

	public function inArray($array, $message = 'Not in the array!')
	{
		if ( !in_array($this->value, $array) )
			throw new ValidationException($message, 7);
		return $this;
	}

	public function sentence($message = 'Only chars, digits and spaces are allowed.')
	{
		if ( !preg_match("/^[a-zA-Z0-9 .]+$/", $this->value) )
			throw new ValidationException($message, 1);
		return $this;
	}
}

/**
* ValidationException
*/
class ValidationException extends Exception {}

?>