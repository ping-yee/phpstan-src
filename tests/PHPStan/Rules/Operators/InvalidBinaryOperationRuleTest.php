<?php declare(strict_types = 1);

namespace PHPStan\Rules\Operators;

use PHPStan\Node\Printer\ExprPrinter;
use PHPStan\Node\Printer\Printer;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;
use const PHP_VERSION_ID;

/**
 * @extends RuleTestCase<InvalidBinaryOperationRule>
 */
class InvalidBinaryOperationRuleTest extends RuleTestCase
{

	private bool $checkExplicitMixed = false;

	private bool $checkImplicitMixed = false;

	protected function getRule(): Rule
	{
		return new InvalidBinaryOperationRule(
			new ExprPrinter(new Printer()),
			new RuleLevelHelper($this->createReflectionProvider(), true, false, true, $this->checkExplicitMixed, $this->checkImplicitMixed, false),
		);
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/invalid-binary.php'], [
			[
				'Binary operation "-" between array and array results in an error.',
				12,
			],
			[
				'Binary operation "/" between 5 and 0 results in an error.',
				15,
			],
			[
				'Binary operation "%" between 5 and 0 results in an error.',
				16,
			],
			[
				'Binary operation "/" between int and 0.0 results in an error.',
				17,
			],
			[
				'Binary operation "+" between 1 and string results in an error.',
				20,
			],
			[
				'Binary operation "+" between 1 and \'blabla\' results in an error.',
				21,
			],
			[
				'Binary operation "+=" between array and \'foo\' results in an error.',
				28,
			],
			[
				'Binary operation "-=" between array and array results in an error.',
				34,
			],
			[
				'Binary operation "<<" between string and string results in an error.',
				47,
			],
			[
				'Binary operation ">>" between string and string results in an error.',
				48,
			],
			[
				'Binary operation ">>=" between string and string results in an error.',
				49,
			],
			[
				'Binary operation "<<=" between string and string results in an error.',
				59,
			],
			[
				'Binary operation "&" between string and 5 results in an error.',
				69,
			],
			[
				'Binary operation "|" between string and 5 results in an error.',
				73,
			],
			[
				'Binary operation "^" between string and 5 results in an error.',
				77,
			],
			[
				'Binary operation "." between string and stdClass results in an error.',
				87,
			],
			[
				'Binary operation ".=" between string and stdClass results in an error.',
				91,
			],
			[
				'Binary operation "/" between 5 and 0|1 results in an error.',
				122,
			],
			[
				'Binary operation "." between array and \'xyz\' results in an error.',
				127,
			],
			[
				'Binary operation "." between list<string>|string and \'xyz\' results in an error.',
				134,
			],
			[
				'Binary operation "+" between (list<string>|string) and 1 results in an error.',
				136,
			],
			[
				'Binary operation "+" between stdClass and int results in an error.',
				157,
			],
			[
				'Binary operation "+" between non-empty-string and 10 results in an error.',
				184,
			],
			[
				'Binary operation "-" between non-empty-string and 10 results in an error.',
				185,
			],
			[
				'Binary operation "*" between non-empty-string and 10 results in an error.',
				186,
			],
			[
				'Binary operation "/" between non-empty-string and 10 results in an error.',
				187,
			],
			[
				'Binary operation "+" between 10 and non-empty-string results in an error.',
				189,
			],
			[
				'Binary operation "-" between 10 and non-empty-string results in an error.',
				190,
			],
			[
				'Binary operation "*" between 10 and non-empty-string results in an error.',
				191,
			],
			[
				'Binary operation "/" between 10 and non-empty-string results in an error.',
				192,
			],
			[
				'Binary operation "+" between string and 10 results in an error.',
				194,
			],
			[
				'Binary operation "-" between string and 10 results in an error.',
				195,
			],
			[
				'Binary operation "*" between string and 10 results in an error.',
				196,
			],
			[
				'Binary operation "/" between string and 10 results in an error.',
				197,
			],
			[
				'Binary operation "+" between 10 and string results in an error.',
				199,
			],
			[
				'Binary operation "-" between 10 and string results in an error.',
				200,
			],
			[
				'Binary operation "*" between 10 and string results in an error.',
				201,
			],
			[
				'Binary operation "/" between 10 and string results in an error.',
				202,
			],
			[
				'Binary operation "+" between class-string and 10 results in an error.',
				204,
			],
			[
				'Binary operation "-" between class-string and 10 results in an error.',
				205,
			],
			[
				'Binary operation "*" between class-string and 10 results in an error.',
				206,
			],
			[
				'Binary operation "/" between class-string and 10 results in an error.',
				207,
			],
			[
				'Binary operation "+" between 10 and class-string results in an error.',
				209,
			],
			[
				'Binary operation "-" between 10 and class-string results in an error.',
				210,
			],
			[
				'Binary operation "*" between 10 and class-string results in an error.',
				211,
			],
			[
				'Binary operation "/" between 10 and class-string results in an error.',
				212,
			],
			[
				'Binary operation "+" between literal-string and 10 results in an error.',
				214,
			],
			[
				'Binary operation "-" between literal-string and 10 results in an error.',
				215,
			],
			[
				'Binary operation "*" between literal-string and 10 results in an error.',
				216,
			],
			[
				'Binary operation "/" between literal-string and 10 results in an error.',
				217,
			],
			[
				'Binary operation "+" between 10 and literal-string results in an error.',
				219,
			],
			[
				'Binary operation "-" between 10 and literal-string results in an error.',
				220,
			],
			[
				'Binary operation "*" between 10 and literal-string results in an error.',
				221,
			],
			[
				'Binary operation "/" between 10 and literal-string results in an error.',
				222,
			],
			[
				'Binary operation "+" between int and array{} results in an error.',
				259,
			],
			[
				'Binary operation "%" between array and 3 results in an error.',
				267,
			],
			[
				'Binary operation "%" between 3 and array results in an error.',
				268,
			],
			[
				'Binary operation "%" between object and 3 results in an error.',
				270,
			],
			[
				'Binary operation "%" between 3 and object results in an error.',
				271,
			],
		]);
	}

	public function testBug2964(): void
	{
		$this->analyse([__DIR__ . '/data/bug2964.php'], []);
	}

	public function testBug3515(): void
	{
		$this->analyse([__DIR__ . '/data/bug-3515.php'], []);
	}

	public function testBug8827(): void
	{
		$this->analyse([__DIR__ . '/../../Analyser/nsrt/bug-8827.php'], []);
	}

	public function testRuleWithNullsafeVariant(): void
	{
		if (PHP_VERSION_ID < 80000) {
			$this->markTestSkipped('Test requires PHP 8.0.');
		}

		$this->analyse([__DIR__ . '/data/invalid-binary-nullsafe.php'], [
			[
				'Binary operation "+" between array|null and \'2\' results in an error.',
				12,
			],
		]);
	}

	public function testBug5309(): void
	{
		$this->analyse([__DIR__ . '/data/bug-5309.php'], []);
	}

	public function testBinaryMixed(): void
	{
		if (PHP_VERSION_ID < 80000) {
			self::markTestSkipped('Test requires PHP 8.0.');
		}

		$this->checkExplicitMixed = true;
		$this->checkImplicitMixed = true;
		$this->analyse([__DIR__ . '/data/invalid-binary-mixed.php'], [
			[
				'Binary operation "." between T and \'a\' results in an error.',
				11,
			],
			[
				'Binary operation ".=" between \'a\' and T results in an error.',
				13,
			],
			[
				'Binary operation "**" between T and 2 results in an error.',
				15,
			],
			[
				'Binary operation "*" between T and 2 results in an error.',
				16,
			],
			[
				'Binary operation "/" between T and 2 results in an error.',
				17,
			],
			[
				'Binary operation "%" between T and 2 results in an error.',
				18,
			],
			[
				'Binary operation "+" between T and 2 results in an error.',
				19,
			],
			[
				'Binary operation "-" between T and 2 results in an error.',
				20,
			],
			[
				'Binary operation "<<" between T and 2 results in an error.',
				21,
			],
			[
				'Binary operation ">>" between T and 2 results in an error.',
				22,
			],
			[
				'Binary operation "&" between T and 2 results in an error.',
				23,
			],
			[
				'Binary operation "|" between T and 2 results in an error.',
				24,
			],
			[
				'Binary operation "+=" between 5 and T results in an error.',
				26,
			],
			[
				'Binary operation "-=" between 5 and T results in an error.',
				29,
			],
			[
				'Binary operation "*=" between 5 and T results in an error.',
				32,
			],
			[
				'Binary operation "**=" between 5 and T results in an error.',
				35,
			],
			[
				'Binary operation "/=" between 5 and T results in an error.',
				38,
			],
			[
				'Binary operation "%=" between 5 and T results in an error.',
				41,
			],
			[
				'Binary operation "&=" between 5 and T results in an error.',
				44,
			],
			[
				'Binary operation "|=" between 5 and T results in an error.',
				47,
			],
			[
				'Binary operation "^=" between 5 and T results in an error.',
				50,
			],
			[
				'Binary operation "<<=" between 5 and T results in an error.',
				53,
			],
			[
				'Binary operation ">>=" between 5 and T results in an error.',
				56,
			],
			[
				'Binary operation "." between mixed and \'a\' results in an error.',
				61,
			],
			[
				'Binary operation ".=" between \'a\' and mixed results in an error.',
				63,
			],
			[
				'Binary operation "**" between mixed and 2 results in an error.',
				65,
			],
			[
				'Binary operation "*" between mixed and 2 results in an error.',
				66,
			],
			[
				'Binary operation "/" between mixed and 2 results in an error.',
				67,
			],
			[
				'Binary operation "%" between mixed and 2 results in an error.',
				68,
			],
			[
				'Binary operation "+" between mixed and 2 results in an error.',
				69,
			],
			[
				'Binary operation "-" between mixed and 2 results in an error.',
				70,
			],
			[
				'Binary operation "<<" between mixed and 2 results in an error.',
				71,
			],
			[
				'Binary operation ">>" between mixed and 2 results in an error.',
				72,
			],
			[
				'Binary operation "&" between mixed and 2 results in an error.',
				73,
			],
			[
				'Binary operation "|" between mixed and 2 results in an error.',
				74,
			],
			[
				'Binary operation "+=" between 5 and mixed results in an error.',
				76,
			],
			[
				'Binary operation "-=" between 5 and mixed results in an error.',
				79,
			],
			[
				'Binary operation "*=" between 5 and mixed results in an error.',
				82,
			],
			[
				'Binary operation "**=" between 5 and mixed results in an error.',
				85,
			],
			[
				'Binary operation "/=" between 5 and mixed results in an error.',
				88,
			],
			[
				'Binary operation "%=" between 5 and mixed results in an error.',
				91,
			],
			[
				'Binary operation "&=" between 5 and mixed results in an error.',
				94,
			],
			[
				'Binary operation "|=" between 5 and mixed results in an error.',
				97,
			],
			[
				'Binary operation "^=" between 5 and mixed results in an error.',
				100,
			],
			[
				'Binary operation "<<=" between 5 and mixed results in an error.',
				103,
			],
			[
				'Binary operation ">>=" between 5 and mixed results in an error.',
				106,
			],
			[
				'Binary operation "." between mixed and \'a\' results in an error.',
				111,
			],
			[
				'Binary operation ".=" between \'a\' and mixed results in an error.',
				113,
			],
			[
				'Binary operation "**" between mixed and 2 results in an error.',
				115,
			],
			[
				'Binary operation "*" between mixed and 2 results in an error.',
				116,
			],
			[
				'Binary operation "/" between mixed and 2 results in an error.',
				117,
			],
			[
				'Binary operation "%" between mixed and 2 results in an error.',
				118,
			],
			[
				'Binary operation "+" between mixed and 2 results in an error.',
				119,
			],
			[
				'Binary operation "-" between mixed and 2 results in an error.',
				120,
			],
			[
				'Binary operation "<<" between mixed and 2 results in an error.',
				121,
			],
			[
				'Binary operation ">>" between mixed and 2 results in an error.',
				122,
			],
			[
				'Binary operation "&" between mixed and 2 results in an error.',
				123,
			],
			[
				'Binary operation "|" between mixed and 2 results in an error.',
				124,
			],
			[
				'Binary operation "+=" between 5 and mixed results in an error.',
				126,
			],
			[
				'Binary operation "-=" between 5 and mixed results in an error.',
				129,
			],
			[
				'Binary operation "*=" between 5 and mixed results in an error.',
				132,
			],
			[
				'Binary operation "**=" between 5 and mixed results in an error.',
				135,
			],
			[
				'Binary operation "/=" between 5 and mixed results in an error.',
				138,
			],
			[
				'Binary operation "%=" between 5 and mixed results in an error.',
				141,
			],
			[
				'Binary operation "&=" between 5 and mixed results in an error.',
				144,
			],
			[
				'Binary operation "|=" between 5 and mixed results in an error.',
				147,
			],
			[
				'Binary operation "^=" between 5 and mixed results in an error.',
				150,
			],
			[
				'Binary operation "<<=" between 5 and mixed results in an error.',
				153,
			],
			[
				'Binary operation ">>=" between 5 and mixed results in an error.',
				156,
			],
		]);
	}

	public function testBug7538(): void
	{
		$this->analyse([__DIR__ . '/data/bug-7538.php'], [
			[
				'Binary operation "%" between stdClass and stdClass results in an error.',
				7,
			],
		]);
	}

	public function testBug10440(): void
	{
		$this->analyse([__DIR__ . '/data/bug-10440.php'], [
			[
				'Binary operation "%" between array{} and array{\'\'} results in an error.',
				8,
			],
		]);
	}

	public function testBenevolentUnion(): void
	{
		$this->analyse([__DIR__ . '/data/binary-op-benevolent-union.php'], [
			[
				'Binary operation "+" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\Foo results in an error.',
				12,
			],
			[
				'Binary operation "+=" between BinaryOpBenevolentUnion\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				24,
			],
			[
				'Binary operation "**" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				42,
			],
			[
				'Binary operation "**" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				43,
			],
			[
				'Binary operation "**=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				52,
			],
			[
				'Binary operation "**=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				55,
			],
			[
				'Binary operation "*" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				73,
			],
			[
				'Binary operation "*" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				74,
			],
			[
				'Binary operation "*=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				83,
			],
			[
				'Binary operation "*=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				86,
			],
			[
				'Binary operation "/" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				104,
			],
			[
				'Binary operation "/" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				105,
			],
			[
				'Binary operation "/=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				114,
			],
			[
				'Binary operation "/=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				117,
			],
			[
				'Binary operation "%" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				135,
			],
			[
				'Binary operation "%" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				136,
			],
			[
				'Binary operation "%=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				145,
			],
			[
				'Binary operation "%=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				148,
			],
			[
				'Binary operation "-" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				166,
			],
			[
				'Binary operation "-" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				167,
			],
			[
				'Binary operation "-=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				176,
			],
			[
				'Binary operation "-=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				179,
			],
			[
				'Binary operation "." between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				197,
			],
			[
				'Binary operation "." between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				198,
			],
			[
				'Binary operation ".=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				207,
			],
			[
				'Binary operation ".=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				210,
			],
			[
				'Binary operation "<<" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				228,
			],
			[
				'Binary operation "<<" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				229,
			],
			[
				'Binary operation "<<=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				238,
			],
			[
				'Binary operation "<<=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				241,
			],
			[
				'Binary operation ">>" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				259,
			],
			[
				'Binary operation ">>" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				260,
			],
			[
				'Binary operation ">>=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				269,
			],
			[
				'Binary operation ">>=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				272,
			],
			[
				'Binary operation "&" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				290,
			],
			[
				'Binary operation "&" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				291,
			],
			[
				'Binary operation "&=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				300,
			],
			[
				'Binary operation "&=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				303,
			],
			[
				'Binary operation "^" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				321,
			],
			[
				'Binary operation "^" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				322,
			],
			[
				'Binary operation "^=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				331,
			],
			[
				'Binary operation "^=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				334,
			],
			[
				'Binary operation "|" between (array<string, string>|bool|int|object|resource) and array{} results in an error.',
				352,
			],
			[
				'Binary operation "|" between (array<string, string>|bool|int|object|resource) and BinaryOpBenevolentUnion\\Foo results in an error.',
				353,
			],
			[
				'Binary operation "|=" between array{} and (array<string, string>|bool|int|object|resource) results in an error.',
				362,
			],
			[
				'Binary operation "|=" between BinaryOpBenevolentUnion\\Foo and (array<string, string>|bool|int|object|resource) results in an error.',
				365,
			],
		]);
	}

	public function testBug7863(): void
	{
		$this->checkImplicitMixed = true;

		$this->analyse([__DIR__ . '/data/bug-7863.php'], [
			[
				'Binary operation "+" between mixed and array results in an error.',
				10,
			],
		]);
	}

}
