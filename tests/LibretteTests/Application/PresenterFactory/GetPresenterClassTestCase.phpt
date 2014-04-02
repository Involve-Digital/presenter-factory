<?php
namespace LibretteTests\Application\PresenterFactory;

use Librette;
use Nette\Application\Request;
use Nette;
use Tester\Assert;
use Tester;

require_once __DIR__ . '/../../bootstrap.php';


class PresenterObjectFactoryMock implements Librette\Application\PresenterFactory\IPresenterObjectFactory
{

	public function createPresenter($class)
	{
	}

}


class BarPresenter implements Nette\Application\IPresenter
{

	function run(Request $request)
	{
	}

}


/**
 * @author David Matějka
 */
class GetPresenterClassTestCase extends Tester\TestCase
{

	/** @var Librette\Application\PresenterFactory\PresenterFactory */
	protected $presenterFactory;


	public function setUp()
	{
		$this->presenterFactory = $presenterFactory = new Librette\Application\PresenterFactory\PresenterFactory(new PresenterObjectFactoryMock());
		$presenterFactory->addMapping('Foo', 'LibretteTests\\Application\\PresenterFactory\\*Presenter');
		$presenterFactory->addMapping('Foo', 'App\\*Presenter');
	}


	public function testGetPresenterClass()
	{
		$presenterName = 'Foo:Bar';
		$class = $this->presenterFactory->getPresenterClass($presenterName);
		Assert::same('LibretteTests\\Application\\PresenterFactory\\BarPresenter', $class);
	}


	public function testInvalidPresenterName()
	{
		Assert::exception(function () {
			$presenterName = 'xxx-yyy';
			$this->presenterFactory->getPresenterClass($presenterName);
		}, 'Nette\Application\InvalidPresenterException', "Presenter name must be alphanumeric string, 'xxx-yyy' is invalid.");
	}


	public function testNonExistingClass()
	{
		Assert::exception(function () {
			$name = 'Foo:Lorem';
			$this->presenterFactory->getPresenterClass($name);
		}, 'Nette\Application\InvalidPresenterException', "Cannot load presenter 'Foo:Lorem', none of following classes were found: App\\LoremPresenter, LibretteTests\\Application\\PresenterFactory\\LoremPresenter");
	}


	public function testNoMapping()
	{
		Assert::exception(function () {
			$name = 'Bar:Foo';
			$this->presenterFactory->getPresenterClass($name);
		}, 'Nette\Application\InvalidPresenterException', "Cannot load presenter 'Bar:Foo', no applicable mapping found.");
	}
}


\run(new GetPresenterClassTestCase());