<?php // lint >= 8.4

declare(strict_types=1);

namespace PropertyHooksTypes;

use function PHPStan\Testing\assertType;

class Foo
{

	public int $i {
		set {
			assertType('int', $value);
		}
	}

	public int $j {
		set (int $val) {
			assertType('int', $val);
		}
	}

	public int $k {
		set (int|string $val) {
			assertType('int|string', $val);
		}
	}

	/** @var array<string> */
	public array $l {
		set {
			assertType('array<string>', $value);
		}
	}

	/** @var array<string> */
	public array $m {
		set (array $val) {
			assertType('array<string>', $val);
		}
	}

	public int $n {
		/** @param int|array<string> $val */
		set (int|array $val) {
			assertType('array<string>|int', $val);
		}
	}

}

class FooShort
{

	public int $i {
		set => assertType('int', $value);
	}

	public int $j {
		set (int $val) => assertType('int', $val);
	}

	public int $k {
		set (int|string $val) => assertType('int|string', $val);
	}

	/** @var array<string> */
	public array $l {
		set => assertType('array<string>', $value);
	}

	/** @var array<string> */
	public array $m {
		set (array $val) => assertType('array<string>', $val);
	}

	public int $n {
		/** @param int|array<string> $val */
		set (int|array $val) => assertType('array<string>|int', $val);
	}

}

class FooConstructor
{

	public function __construct(
		public int $i {
			set {
				assertType('int', $value);
			}
		},
		public int $j {
			set (int $val) {
				assertType('int', $val);
			}
		},
		public int $k {
			set (int|string $val) {
				assertType('int|string', $val);
			}
		},
		/** @var array<string> */
		public array $l {
			set {
				assertType('array<string>', $value);
			}
		},
		/** @var array<string> */
		public array $m {
			set (array $val) {
				assertType('array<string>', $val);
			}
		},
		public int $n {
			/** @param int|array<string> $val */
			set (int|array $val) {
				assertType('array<string>|int', $val);
			}
		},
	) {

	}

}

class FooConstructorWithParam
{

	/**
	 * @param array<string> $l
	 * @param array<string> $m
	 */
	public function __construct(
		public array $l {
			set {
				assertType('array<string>', $value);
			}
		},
		public array $m {
			set (array $val) {
				assertType('array<string>', $val);
			}
		},
	) {

	}

}

/**
 * @template T of \stdClass
 */
class FooGenerics
{

	/** @var array<T> */
	public array $m {
		set (array $val) {
			assertType('array<T of stdClass (class PropertyHooksTypes\FooGenerics, argument)>', $val);
		}
	}

	public int $n {
		/** @param int|array<T> $val */
		set (int|array $val) {
			assertType('array<T of stdClass (class PropertyHooksTypes\FooGenerics, argument)>|int', $val);
		}
	}

}

/**
 * @template T of \stdClass
 */
class FooGenericsConstructor
{

	public function __construct(
		/** @var array<T> */
		public array $l {
			set {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor, argument)>', $value);
			}
		},
		/** @var array<T> */
		public array $m {
			set (array $val) {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor, argument)>', $val);
			}
		},
		public int $n {
			/** @param int|array<T> $val */
			set (int|array $val) {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor, argument)>|int', $val);
			}
		},
	) {

	}

}

/**
 * @template T of \stdClass
 */
class FooGenericsConstructor2
{

	/**
	 * @param array<T> $l
	 * @param array<T> $m
	 */
	public function __construct(
		public array $l {
			set {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor2, argument)>', $value);
			}
		},
		public array $m {
			set (array $val) {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor2, argument)>', $val);
			}
		},
		public int $n {
			/** @param int|array<T> $val */
			set (int|array $val) {
				assertType('array<T of stdClass (class PropertyHooksTypes\FooGenericsConstructor2, argument)>|int', $val);
			}
		},
	) {

	}

}

class FooGenericsConstructorWithT
{

	/**
	 * @template T of \stdClass
	 */
	public function __construct(
		/** @var array<T> */
		public array $l {
			set {
				assertType('array<T of stdClass (method PropertyHooksTypes\FooGenericsConstructorWithT::__construct(), argument)>', $value);
			}
		},
		/** @var array<T> */
		public array $m {
			set (array $val) {
				assertType('array<T of stdClass (method PropertyHooksTypes\FooGenericsConstructorWithT::__construct(), argument)>', $val);
			}
		},
	) {

	}

}

class FooGenericsConstructorWithT2
{

	/**
	 * @template T of \stdClass
	 * @param array<T> $l
	 * @param array<T> $m
	 */
	public function __construct(
		public array $l {
			set {
				assertType('array<T of stdClass (method PropertyHooksTypes\FooGenericsConstructorWithT2::__construct(), argument)>', $value);
			}
		},
		public array $m {
			set (array $val) {
				assertType('array<T of stdClass (method PropertyHooksTypes\FooGenericsConstructorWithT2::__construct(), argument)>', $val);
			}
		},
	) {

	}

}
