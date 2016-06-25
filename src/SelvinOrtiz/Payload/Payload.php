<?php
namespace SelvinOrtiz\Payload;

use SelvinOrtiz\Dot\Dot;

class Payload
{
	protected $data;

	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	public function get($name = null, $default = null)
	{
		if ($name === null)
		{
			return $this->data;
		}

		return Dot::get($this->data, $name, $default);
	}

	public function set($name, $value)
	{
		Dot::set($this->data, $name, $value);
	}
}
