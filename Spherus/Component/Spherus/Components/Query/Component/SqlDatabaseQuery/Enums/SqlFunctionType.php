<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Components\Query\Component\SqlDatabaseQuery\Enums;

	use Spherus\Core\Enums\Enum;
	
	/**
     * Class that represents the function section enum type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.components.query
     */
    class SqlFunctionType extends Enum
	{
	    const Entry = 'Entry';
	    const Exit_ = 'Exit';
	    const ArgumentDelimiter = 'ArgumentDelimiter';
	    const ArgumentEntry = 'ArgumentEntry';
	    const ArgumentExit = 'ArgumentExit';
		const Concat = 'Concat';
		const CurrentDate = 'CurrentDate';
		const CurrentTime = 'CurrentTime';
		const CurrentTimeStamp = 'CurrentTimeStamp';
		const Lower = 'Lower';
		const CharLength = 'CharLength';
		const BinaryLength = 'BinaryLength';
		const Position = 'Position';
		const Replace = 'Replace';
		const Substring = 'Substring';
		const Upper = 'Upper';
		const UserDefined = 'UserDefined';
		const CurrentUser = 'CurrentUser';
		const SessionUser = 'SessionUser';
		const SystemUser = 'SystemUser';
		const User = 'User';
		const NullIf = 'NullIf';
		const Coalesce = 'Coalesce';
		const LastInsertedId = 'LastInsertedId';
		const PadLeft = 'PadLeft';
		const PadRight = 'PadRight';
		const Abs = 'Abs';
		const Acos = 'Acos';
		const Asin = 'Asin';
		const Atan = 'Atan';
		const Atan2 = 'Atan2';
		const Ceiling = 'Ceiling';
		const Cos = 'Cos';
		const Cot = 'Cot';
		const Degrees = 'Degrees';
		const Exp = 'Exp';
		const Floor = 'Floor';
		const Log = 'Log';
		const Log10 = 'Log10';
		const Pi = 'Pi';
		const Power = 'Power';
		const Radians = 'Radians';
		const Rand = 'Rand';
		const Round = 'Round';
		const Truncate = 'Truncate';
		const Sign = 'Sign';
		const Sin = 'Sin';
		const Sqrt = 'Sqrt';
		const Square = 'Square';
		const Tan = 'Tan';
	}