<?php

declare(strict_types=1);

/**
 * NumericValue class.
 *
 * @copyright YetiForce Sp. z o.o.
 * @license YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author Rafal Pospiech <r.pospiech@yetiforce.com>
 */

namespace YetiForcePDF\Style;

/**
 * Class NumericValue.
 */
class NumericValue
{
	/**
	 * Original css value 12px for example.
	 *
	 * @var string
	 */
	private $original;
	/**
	 * Numeric string representation of original value (without unit).
	 *
	 * @var string
	 */
	private $value;
	/**
	 * Unit of original value for '12px' it will be 'px'.
	 *
	 * @var string
	 */
	private $unit;
	/**
	 * Converted to pixel value from other unit (from 'em' for example).
	 *
	 * @var string
	 */
	private $converted;
	/**
	 * Is this numeric value for font size?
	 *
	 * @var bool
	 */
	private $isFont;
	/**
	 * Style needed to convert values from 'em' to px for example.
	 *
	 * @var Style
	 */
	private $style;

	/**
	 * Initialize numeric value.
	 *
	 * @param string $value  css value 12px for example
	 * @param Style  $style
	 * @param bool   $isFont
	 *
	 * @return self
	 */
	public function init(string $value, Style $style, bool $isFont = false)
	{
		$this->original = $value;
		$this->value = \YetiForcePDF\Style\Normalizer\Normalizer::getNumericValue($value);
		$this->unit = \YetiForcePDF\Style\Normalizer\Normalizer::getNumericUnit($value);
		$this->converted = $style->convertUnits($this->unit, $this->value, $isFont);
		$this->isFont = $isFont;
		$this->style = $style;
		return $this;
	}

	/**
	 * Get numeric value out of string value or return original if it's not numeric.
	 *
	 * @param any|string $value
	 * @param Style      $style
	 * @param bool       $isFont
	 *
	 * @return any|NumericValue
	 */
	public static function get($value, Style $style, bool $isFont = false)
	{
		if (!is_string($value)) {
			return $value;
		}
		if (\YetiForcePDF\Style\Normalizer\Normalizer::getNumericValue($value) !== false) {
			return (new self())->init($value, $style, $isFont);
		}
		return $value;
	}

	/**
	 * Get the value of original.
	 *
	 * @return string
	 */
	public function getOriginal(): string
	{
		return $this->original;
	}

	/**
	 * Set the value of original.
	 *
	 * @param string $original
	 *
	 * @return self
	 */
	public function setOriginal(string $original)
	{
		$this->original = $original;

		return $this;
	}

	/**
	 * Get the value of value.
	 *
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * Set the value of value.
	 *
	 * @param string $value
	 *
	 * @return self
	 */
	public function setValue(string $value)
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * Get the value of unit.
	 *
	 * @return string
	 */
	public function getUnit(): string
	{
		return $this->unit;
	}

	/**
	 * Set the value of unit.
	 *
	 * @param string $unit
	 *
	 * @return self
	 */
	public function setUnit(string $unit)
	{
		$this->unit = $unit;

		return $this;
	}

	/**
	 * Get the value of converted.
	 *
	 * @return string
	 */
	public function getConverted(): string
	{
		return $this->converted;
	}

	/**
	 * Set the value of converted.
	 *
	 * @param string $converted
	 *
	 * @return self
	 */
	public function setConverted(string $converted)
	{
		$this->converted = $converted;

		return $this;
	}

	/**
	 * Convert unit.
	 *
	 * @return self
	 */
	public function convert()
	{
		$this->converted = $this->style->convertUnits($this->unit, $this->value, $this->isFont);
		return $this;
	}

	/**
	 * Get the value of isFont.
	 *
	 * @return bool
	 */
	public function getIsFont(): bool
	{
		return $this->isFont;
	}

	/**
	 * Set the value of isFont.
	 *
	 * @param bool $isFont
	 *
	 * @return self
	 */
	public function setIsFont(bool $isFont)
	{
		$this->isFont = $isFont;

		return $this;
	}

	public function __toString()
	{
		return $this->converted;
	}

	/**
	 * Get style needed to convert values from 'em' to px for example.
	 *
	 * @return Style
	 */
	public function getStyle(): Style
	{
		return $this->style;
	}

	/**
	 * Set style needed to convert values from 'em' to px for example.
	 *
	 * @param Style $style Style needed to convert values from 'em' to px for example.
	 *
	 * @return self
	 */
	public function setStyle(Style $style)
	{
		$this->style = $style;

		return $this;
	}

	public function __get($param)
	{
		if (empty($param)) {
			return $this->converted;
		}
		return $this->{$param};
	}

	public function __set($param, $value)
	{
		$this->original = $value . 'px';
		$this->value = $value;
		$this->unit = 'px';
		$this->converted = $value;
	}
}