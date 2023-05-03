<?php

namespace WHDoctrine\Hydration;

use Doctrine\ORM\Internal\Hydration\ArrayHydrator;

use WHPHP\Util\ArrayUtil;

/**
 * Hydrator which produces an associated, single-dimensional array IF selecting only two columns, one of which is a scalar specified for use as the index.
 *  * Produces an indexed, single-dimensional array if selecting only one column which has not been specified for index use.
 *  * In all other cases the results are unmodified from those produced by the normal Doctrine ArrayHydrator.
 *
 * Inspired by (but very different from) Gabriel Ostrolucký's ColumnHydrator class <https://gist.github.com/ostrolucky/f9f1e0b271357573fde55b7a2ba91a32>
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
class SimplifiedArrayHydrator extends ArrayHydrator
{
	/**
	 * @inheritdoc
	 */
	protected function hydrateAllData(): array
	{
		$result = parent::hydrateAllData();

		if( empty($result) ) {
			return $result;
		}

		$resultColumns = array_keys(reset($result));

		if( isset($this->_rsm->indexByMap['scalars']) ) {
			$indexColumn = $this->_rsm->scalarMappings[$this->_rsm->indexByMap['scalars']];

			ArrayUtil::removeValue($resultColumns, $indexColumn);
		}

		if( count($resultColumns) === 1 ) {
			$valueColumn = array_shift($resultColumns);

			if( isset($indexColumn) ) {
				$result = array_column($result, $valueColumn, $indexColumn);
			} else {
				$result = array_column($result, $valueColumn);
			}
		}

		return $result;
	}
}
