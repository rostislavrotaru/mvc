<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */

	/**
	 * Interface that represents the RequestType enum implementation
	 *
	 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
	 * @package spherus.core
	 */
	namespace Spherus\Core\Enums;

	interface RequestType
	{
		const GET = 'GET';
		const POST = 'POST';
		const OPTIONS = 'OPTIONS';
		const HEAD = 'HEAD';
		const PUT = 'PUT';
		const DELETE = 'DELETE';
		const TRACE = 'TRACE';
		const CONNECT = 'CONNECT';
	}
