<?php

namespace WHDoctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Replace Doctrine DBAL's now-deprecated ArrayType with one which allows being set to NULL.
 * Omits the custom error handling of the original when calling unserialize().
 *
 * Note: Some code in this package assumes that this type is configured using the alias "array_nullable"
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
class NullableArrayType extends Type
{
	/**
	 * {@inheritdoc}
	 */
	public function getName(): string
	{
		return 'array';
	}

	/**
	 * @inheritDoc
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
	{
		if( $value === null ) {
			return null;
		}

		return serialize($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): mixed
	{
		if ($value === null) {
			return null;
		}

		$value = is_resource($value) ? stream_get_contents($value) : $value;

		return unserialize($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
	{
		return $platform->getClobTypeDeclarationSQL($column);
	}
}
