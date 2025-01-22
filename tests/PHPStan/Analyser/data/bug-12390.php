<?php declare(strict_types = 1);

namespace Bug12390;

class HelloWorld
{
	public function sayHello(string $date): void
	{
		;
		if(is_object($obj = json_decode($date))){
			if(isset($obj->crashId) && is_string($obj->crashId)){
				var_dump($obj->crashId);
			}
		}
	}
}