<?php
declare(strict_types=1);
/**
 * DictionaryObject class
 *
 * @package   YetiForcePDF\Objects\Basic
 *
 * @copyright YetiForce Sp. z o.o
 * @license   MIT
 * @author    Rafal Pospiech <r.pospiech@yetiforce.com>
 */

namespace YetiForcePDF\Objects\Basic;

/**
 * Class DictionaryObject
 */
class DictionaryObject extends \YetiForcePDF\Objects\PdfObject
{
	/**
	 * Basic object type (integer, string, boolean, dictionary etc..)
	 * @var string
	 */
	protected $basicType = 'Dictionary';
	/**
	 * Object name
	 * @var string
	 */
	protected $name = 'Dictionary';
	/**
	 * Which type of dictionary (Page, Catalog, Font etc...)
	 * @var string
	 */
	protected $dictionaryType = '';

	/**
	 * Initialisation
	 * @return $this
	 */
	public function init()
	{
		parent::init();
		$this->id = $this->document->getActualId();
		return $this;
	}

	/**
	 * Get dictionary type (Page, Catalog, Font etc...)
	 * @return string
	 */
	public function getDictionaryType()
	{
		return $this->dictionaryType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(): string
	{
		return "<<\n\t/Type /{$this->dictionaryType}\n>>\n";
	}
}
