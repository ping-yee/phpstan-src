<?php declare(strict_types = 1);

namespace Bug12376;

class Base {}

class A extends Base
{
    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return (T is static ? T : static)
     *
     * @phpstan-assert static $object
     */
    public static function assertInstanceOf(object $object)
    {
        if (!$object instanceof static) {
            throw new \Exception();
        }

        return $object;
	}
}

class B extends A {}
class C extends Base {}

// $o = new \DateTime();
// $r = A::assertInstanceOf($o);
// \PHPStan\dumpType($o);
// \PHPStan\dumpType($r);

$o = new A();
$r = A::assertInstanceOf($o);
\PHPStan\dumpType($o);
// \PHPStan\dumpType($r);

// $o = new \B();
// // $r = A::assertInstanceOf($o);
// // \PHPStan\dumpType($o);
// // \PHPStan\dumpType($r);

// $o = new \C();
// $r = A::assertInstanceOf($o);
// \PHPStan\dumpType($o);
// \PHPStan\dumpType($r);

// $o = new \A();
// $r = B::assertInstanceOf($o);
// \PHPStan\dumpType($o);
// \PHPStan\dumpType($r);