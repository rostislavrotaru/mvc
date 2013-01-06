<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\HttpContext;

    use Spherus\Core\Check;

    /**
     * Class that represents the http context cookie object
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.httpcontext
     */
    class Cookie
    {

        /* CONSTRUCTOR */

        /**
         * Initializes a new instance of Cookie class
         *
         * @param string $name
         *            The Cookie name
         * @param string $value
         *            The Cookie value
         * @throws SpherusException When $name parameter is null or empty
         * @throws SpherusException When $value parameter is null or empty
         */
        public function __construct ($name, $value)
        {
            Check::IsNullOrEmpty($name);
            Check::IsNullOrEmpty($value);

            $this->name = $name;
            $this->value = $value;
        }

        /* FIELDS */

        /**
         * Defines the cookie domain
         *
         * @var string
         */
        private $domain = null;

        /**
         * Defines the cookie expires, in seconds
         *
         * @var int
         */
        private $expires = 0;

        /**
         * Defines the cookie name
         *
         * @var string
         */
        private $name = null;

        /**
         * Defines the cookie path
         *
         * @var string
         */
        private $path = null;

        /**
         * Defines the cookie value
         *
         * @var string
         */
        private $value = null;

        /**
         * Defines if the cookie is secured<br />
         * Indicates that the cookie should only be transmitted over a secure
         * HTTPS connection from the client
         *
         * @var boolean
         */
        private $secure = false;

        /**
         * Indicates that the cookie will be accessible only through the HTTP
         * protocol <br />
         * If is set to true, cookie won't be accessible by scripting languages
         *
         * @var boolean
         */
        private $httpOnly = true;

        /* PROPERTIES */

        /**
         * Gets the Cookie domain
         *
         * @return string
         */
        public function getDomain ()
        {
            return $this->domain;
        }

        /**
         * Sets the cookie domain
         *
         * @param string $domain
         *            The Cookie domain name to set
         */
        public function setDomain ($domain)
        {
            $this->domain = $domain;
        }

        /**
         * Gets the cookie expires, in seconds
         *
         * @return int
         */
        public function getExpires ()
        {
            return $this->expires;
        }

        /**
         * Sets the cookie expires
         *
         * @param int $expires
         *            Number of seconds
         */
        public function setExpires ($expires)
        {
            $this->expires = $expires;
        }

        /**
         * Gets the cookie name
         *
         * @return string
         */
        public function getName ()
        {
            return $this->name;
        }

        /**
         * Sets the cookie name
         *
         * @param
         *            string The Cookie name
         */
        public function setName ($name)
        {
            $this->name = $name;
        }

        /**
         * Gets the cookie path
         *
         * @return string Cookie path
         */
        public function getPath ()
        {
            return $this->path;
        }

        /**
         * Sets the cookie path
         *
         * @param
         *            string The Cookie path
         */
        public function setPath ($path)
        {
            $this->path = $path;
        }

        /**
         * Gets the cookie value
         *
         * @return string Cookie value
         */
        public function getValue ()
        {
            return $this->value;
        }

        /**
         * Sets the cookie value
         *
         * @param
         *            string The Cookie value
         */
        public function setValue ($value)
        {
            $this->value = $value;
        }

        /**
         * Gets if the cookie ie secured<br />
         * Indicates that the cookie should only be transmitted over a secure
         * HTTPS connection from the client
         *
         * @return boolean
         */
        public function getSecure ()
        {
            return $this->secure;
        }

        /**
         * Sets if the cookie should be secured<br />
         * Indicates that the cookie should only be transmitted over a secure
         * HTTPS connection from the client
         *
         * @param boolean $secure
         *            The Cookie secure parameter
         */
        public function setSecure ($secure)
        {
            $this->secure = $secure;
        }

        /**
         * Gets that the cookie will be accessible only through the HTTP
         * protocol <br />
         * If is set to true, cookie won't be accessible by scripting languages
         *
         * @return boolean
         */
        public function getHttpOnly ()
        {
            return $this->httpOnly;
        }

        /**
         * Sets if the cookie should be accessible only through the HTTP
         * protocol <br />
         * If is set to true, cookie won't be accessible by scripting languages
         *
         * @param
         *            boolean The Cookie HttpOnly paramater
         */
        public function setHttpOnly ($httpOnly)
        {
            $this->httpOnly = $httpOnly;
        }
    }