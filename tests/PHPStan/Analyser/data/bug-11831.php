<?php declare(strict_types = 1);

namespace Bug11831;

class HelloWorld
{
	/**
	 * @var string[]
	 */
	protected array $data = [];

	/**
	 * @return string[]
	 */
	public function &returnReference(): array
	{
		return $this->data;
	}

	/**
	 * @param string[] $ref
	 */
	public function takeReference(array &$ref): void
	{
		$ref[] = 'test';
	}

	public function test(): void
	{
		$this->takeReference($this->returnReference());
	}
}