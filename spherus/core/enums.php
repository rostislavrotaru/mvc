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
 * Class that represents the enum implementations
 *
 * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
 * @package spherus.core
 */
namespace Spherus\Core
{

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

    interface ResponseStatusType
    {
        // Information
        const _Continue = 100;

        const SwitchingProtocols = 101;

        const Checkpoint = 103;
        // Successful
        const OK = 200;

        const Created = 201;

        const Accepted = 202;

        const NonAuthoritativeInformation = 203;

        const NoContent = 204;

        const ResetContent = 205;

        const PartialContent = 206;
        // Redirection
        const MultipleChoices = 300;

        const MovedPermanently = 301;

        const Found = 302;

        const SeeOther = 303;

        const NotModified = 304;

        const TemporaryRedirect = 307;

        const ResumeIncomplete = 308;
        // Client Error
        const BadRequest = 400;

        const Unauthorized = 401;

        const PaymentRequired = 402;

        const Forbidden = 403;

        const NotFound = 404;

        const MethodNotAllowed = 405;

        const NotAcceptable = 406;

        const ProxyAuthenticationRequired = 407;

        const RequestTimeout = 408;

        const Conflict = 409;

        const Gone = 410;

        const LengthRequired = 411;

        const PreconditionFailed = 412;

        const RequestEntityTooLarge = 413;

        const RequestUriTooLong = 414;

        const UnsupportedMediaType = 415;

        const RequestedRangeNotSatisfiable = 416;

        const ExpectationFailed = 417;
        // Server Error
        const InternalServerError = 500;

        const NotImplemented = 501;

        const BadGateway = 502;

        const ServiceUnavailable = 503;

        const GatewayTimeout = 504;

        const HttpVersionNotSupported = 505;

        const NetworkAuthenticationRequired = 511;
    }
}
?>