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
     * Class that represents the Select section enum type
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.data
     */
	class SqlEntityType extends Enum
	{
		const Action = 'Action';
		const Add = 'Add';
		const All = 'All';
		const Alter = 'Alter';
		const And_ = 'And';
		const Any = 'Any';
		const Array_ = 'Array';
		const Assign = 'Assign';
		const Avg = 'Avg';
		const Batch = 'Batch';
		const BeginEndBlock = 'BeginEndBlock';
		const Between = 'Between';
		const BitAnd = 'BitAnd';
		const BitNot = 'BitNot';
		const BitOr = 'BitOr';
		const BitXor = 'BitXor';
		const Break_ = 'Break';
		const Case_ = 'Case';
		const Cast = 'Cast';
		const CloseCursor = 'CloseCursor';
		const Collate = 'Collate';
		const Column = 'Column';
		const Command = 'Command';
		const Concat = 'Concat';
		const Conditional = 'Conditional';
		const Continue_ = 'Continue';
		const Container = 'Container';
		const Count = 'Count';
		const Create = 'Create';
		const Cursor = 'Cursor';
		const DateTimePlusInterval = 'DateTimePlusInterval';
		const DateTimeMinusInterval = 'DateTimeMinusInterval';
		const DateTimeMinusDateTime = 'DateTimeMinusDateTime';
		const DeclareCursor = 'DeclareCursor';
		const DefaultValue = 'DefaultValue';
		const Delete = 'Delete';
		const Divide = 'Divide';
		const Drop = 'Drop';
		const DynamicFilter = 'DynamicFilter';
		const RawConcat = 'RawConcat';
		const Equal = 'Equal';
		const Except = 'Except';
		const Exists = 'Exists';
		const Extract = 'Extract';
		const Fetch = 'Fetch';
		const FunctionCall = 'FunctionCall';
		const GreaterThan = 'GreaterThan';
		const GreaterThanOrEqual = 'GreaterThanOrEqual';
		const In = 'In';
		const Insert = 'Insert';
		const Intersect = 'Intersect';
		const IsNull = 'IsNull';
		const IsNotNull = 'IsNotNull';
		const Join = 'Join';
		const Hint = 'Hint';
		const Placeholder = 'Placeholder';
		const LessThan = 'LessThan';
		const LessThanOrEqual = 'LessThanOrEqual';
		const Like = 'Like';
		const Literal = 'Literal';
		const Match = 'Match';
		const Max = 'Max';
		const Min = 'Min';
		const Mod = 'Mod';
		const Multiply = 'Multiply';
		const Native = 'Native';
		const NextValue = 'NextValue';
		const Not = 'Not';
		const NotBetween = 'NotBetween';
		const NotEqual = 'NotEqual';
		const NotIn = 'NotIn';
		const Negate = 'Negate';
		const Null_ = 'Null';
		const OpenCursor = 'OpenCursor';
		const Or_ = 'Or';
		const Order = 'Order';
		const Overlaps = 'Overlaps';
		const Parameter = 'Parameter';
		const Rename = 'Rename';
		const Row = 'Row';
		const RowNumber = 'RowNumber';
		const Round = 'Round';
		const Return_ = 'Return';
		const Select = 'Select';
		const Some = 'Some';
		const SubSelect = 'SubSelect';
		const Subtract = 'Subtract';
		const Sum = 'Sum';
		const Table = 'Table';
		const Trim = 'Trim';
		const Union = 'Union';
		const Unique = 'Unique';
		const Update = 'Update';
		const Variable = 'Variable';
		const Variant = 'Variant';
		const DeclareVariable = 'DeclareVariable';
		const While_ = 'While';
	}