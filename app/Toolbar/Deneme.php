<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Toolbar;

use CodeIgniter\Debug\Toolbar\Collectors\BaseCollector;
use CodeIgniter\Database\Query;

/**
 * Collector for the Database tab of the Debug Toolbar.
 */
class Deneme extends BaseCollector
{
	/**
	 * Whether this collector has timeline data.
	 *
	 * @var boolean
	 */
	protected $hasTimeline = false;

	/**
	 * Whether this collector should display its own tab.
	 *
	 * @var boolean
	 */
	protected $hasTabContent = false;

	/**
	 * Whether this collector has data for the Vars tab.
	 *
	 * @var boolean
	 */
	protected $hasVarData = false;

	/**
	 * The name used to reference this collector in the toolbar.
	 *
	 * @var string
	 */
	protected $title = 'Deneme';

	/**
	 * Array of database connections.
	 *
	 * @var array
	 */
	protected $connections;

	/**
	 * The query instances that have been collected
	 * through the DBQuery Event.
	 *
	 * @var Query[]
	 */
	protected static $queries = [
    [
    'name'      => '',     // Name displayed on the left of the timeline
    'component' => '',     // Name of the Component listed in the middle of timeline
    'start'     => 0.00,   // start time, like microtime(true)
    'duration'  => 0.00    // duration, like mircrotime(true) - microtime(true)
]
  ];

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->connections = \Config\Database::getConnections();
	}

	//--------------------------------------------------------------------

	/**
	 * The static method used during Events to collect
	 * data.
	 *
	 * @param Query $query
	 *
	 * @internal param $ array \CodeIgniter\Database\Query
	 */
	public static function collect(Query $query)
	{
		$config = config('Toolbar');

		// Provide default in case it's not set
		$max = $config->maxQueries ?: 100;

		static::$queries[] = '$query';
	}

	//--------------------------------------------------------------------

	/**
	 * Returns timeline data formatted for the toolbar.
	 *
	 * @return array The formatted data or an empty array.
	 */
	protected function formatTimelineData(): array
	{
		$data = [];

    $data[] = [
  'name'      => '',     // Name displayed on the left of the timeline
  'component' => '',     // Name of the Component listed in the middle of timeline
  'start'     => 0.00,   // start time, like microtime(true)
  'duration'  => 0.00    // duration, like mircrotime(true) - microtime(true)
];
$data[] = [
'name'      => '',     // Name displayed on the left of the timeline
'component' => '',     // Name of the Component listed in the middle of timeline
'start'     => 0.00,   // start time, like microtime(true)
'duration'  => 0.00    // duration, like mircrotime(true) - microtime(true)
];
$data[] = [
'name'      => '',     // Name displayed on the left of the timeline
'component' => '',     // Name of the Component listed in the middle of timeline
'start'     => 0.00,   // start time, like microtime(true)
'duration'  => 0.00    // duration, like mircrotime(true) - microtime(true)
];

		return $data;
	}

	//--------------------------------------------------------------------

	/**
	 * Returns the data of this collector to be formatted in the toolbar
	 *
	 * @return array
	 */
	public function display(): array
	{
		$data['queries'] = \Fluent\Models\DB::getQueryLog();

		return $data;
	}

	//--------------------------------------------------------------------

	/**
	 * Gets the "badge" value for the button.
	 *
	 * @return integer
	 */
	public function getBadgeValue(): int
	{
		return count(static::$queries);
	}

	//--------------------------------------------------------------------

	/**
	 * Information to be displayed next to the title.
	 *
	 * @return string The number of queries (in parentheses) or an empty string.
	 */
	public function getTitleDetails(): string
	{
		return '(' . count(static::$queries) . ' Queries across ' . ($countConnection = count($this->connections)) . ' Connection' .
				($countConnection > 1 ? 's' : '') . ')';
	}

	//--------------------------------------------------------------------

	/**
	 * Does this collector have any data collected?
	 *
	 * @return boolean
	 */
	public function isEmpty(): bool
	{
		return empty(static::$queries);
	}

	//--------------------------------------------------------------------

	/**
	 * Display the icon.
	 *
	 * Icon from https://icons8.com - 1em package
	 *
	 * @return string
	 */
	public function icon(): string
	{
		return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADMSURBVEhLY6A3YExLSwsA4nIycQDIDIhRWEBqamo/UNF/SjDQjF6ocZgAKPkRiFeEhoYyQ4WIBiA9QAuWAPEHqBAmgLqgHcolGQD1V4DMgHIxwbCxYD+QBqcKINseKo6eWrBioPrtQBq/BcgY5ht0cUIYbBg2AJKkRxCNWkDQgtFUNJwtABr+F6igE8olGQD114HMgHIxAVDyAhA/AlpSA8RYUwoeXAPVex5qHCbIyMgwBCkAuQJIY00huDBUz/mUlBQDqHGjgBjAwAAACexpph6oHSQAAAAASUVORK5CYII=';
	}
}
