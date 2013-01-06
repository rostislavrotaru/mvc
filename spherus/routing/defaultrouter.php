<?php

	/**
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright SPHERUS (http://spherus.net)
	 * @license http://license.spherus.net
	 * @link http://spherus.net
	 * @since 3.0
	 */
	namespace Spherus\Routing;

    use Spherus\Interfaces\IRouter;
    use Spherus\HttpContext\Request;
    use Spherus\HttpContext\ParsedUrl;
    use Spherus\Core\SpherusException;
    use Spherus\Core\Check;

    /**
     * Defines a default router class.
     * Used for standard routing.
     *
     *
     * ### How to create routes and supported rules
     *
     * Each route url parameter can have four enclosed in brackets, predefined
     * templates: {module}, {controller}, {action} and {parameters}.
     * This means that in place of these templates the real value of module,
     * controller, action and parameters wil be put.
     * Also, route can contain a plain text, e.g "test". this means that if the
     * route will find in the request url the word "text" - it
     * will try to parse it according to the route rules.
     *
     * Lets simulate some cases:
     *
     * 1.Request url: "/text/blog/title", route url: "text" (or "/text/", it's
     * the same), route module: "anothertext". All other route fields are null.
     * - the router will consider that the "text" is the first element in the
     * url and will substitute with route module: "anothertext".
     * - next element - "blog": the router will understand that it is
     * controller.
     * - next element - "title": the router will understand that it is action.
     * - no more elements: it means that here are no parameters.
     *
     * 2.Request url: "/textarea/blog/title", route url: "tex*", route module:
     * "anothertext". All other route fields are null.
     * - the router will search all values that begins with "tex", and as it is
     * the first element in the url - it will
     * substitute with route module: "anothertext".
     * - next element - "blog": the router will understand that it is
     * controller.
     * - next element - "title": the router will understand that it is action.
     * - no more elements: it means that here are no parameters.
     *
     * 3.Request url: "/blog/textarea/title", route url: "tex*", route module:
     * "anothertext". All other route fields are null.
     * - first: the "blog" element will be substituted with route module field
     * "anothertext".
     * - the router will search all values that begins with "tex", and as it is
     * the second element in the url - it will
     * substitute with route default controller(because the route controller
     * field is null).
     * - next element - "title": the router will understand that it is action.
     * - no more elements: it means that here are no parameters.
     *
     * 4.Request url: "/textarea/blog/title", route url: "*xta*", route module:
     * "anothertext". All other route fields are null.
     * - the router will will search all values that contains "tex", and as it
     * is the first element in the url - it will
     * substitute with route module: "anothertext".
     * - next element - "blog": the router will understand that it is
     * controller.
     * - next element - "title": the router will understand that it is action.
     * - no more elements: it means that here are no parameters.
     *
     * 5.Request url: "/textarea/blog/title/1/4/7", route url:
     * "{controller}/{module}/{action}/{parameters}". All route fields are null.
     * - the router will know that first element in request url is
     * controller(textarea), folowed by module(blog), action(title)
     * and parameters(1/4/7).
     *
     * 6.Request url: "/", route url: "{controller}/{action}/{parameters}". All
     * other route fields are null.
     * - there are no elements in the request url.
     * - no {module} template in the route and module field is missing, so the
     * default module will be used.
     * - {controller} template - will be substituted with default controller.
     * - {action} template - will be substituted with default action.
     * - no more elements: it means that here are no parameters.
     *
     * 7.Request url: "/test", route url:
     * "/main/{controller}/{action}/{parameters}". All route fields are null.
     * - this route will be ignored, because no "test" text found in route url.
     *
     * @author Rostislav Rotaru (rostislav.rotaru@spherus.net)
     * @package spherus.routing
     */
    class DefaultRouter implements IRouter
    {

        /* PUBLIC METHODS */

        /**
         * Parses url into module, controller, action and parameters
         *
         * @return array Array of parsed url(module, controller, action and
         *         parameters)
         * @throws SpherusException When $currentUrl is null or empty
         * @throws SpherusException When default route is not found
         */
        public function Parse ()
        {
            Check::IsNullOrEmpty(Request::getCurrentUrl());

            $foundRoute = self::GetRouteByUrl(Request::getCurrentUrl(), null,
                    null, null);
            $pathPortions = preg_split('/\//', Request::getCurrentUrl(), null,
                    PREG_SPLIT_NO_EMPTY);

            $parameters = array();
            for ($i = 3; $i < count($pathPortions); $i ++) {
                $parameters[] = $pathPortions[$i];
            }

            $module = $foundRoute->getModule();
            $controller = $foundRoute->getController();
            $action = $foundRoute->getAction();

            $result = new ParsedUrl(
                    isset($module) ? $module : (isset($pathPortions[0]) ? $pathPortions[0] : \Config::getRoutingDefaults()['module']),
                    isset($controller) ? $controller : (isset($pathPortions[1]) ? $pathPortions[1] : \Config::getRoutingDefaults()['controller']),
                    isset($action) ? $action : (isset($pathPortions[2]) ? $pathPortions[2] : \Config::getRoutingDefaults()['action']),
                    $parameters, $foundRoute);

            // Unset all unnecessary variables
            unset($pathPortions);
            unset($parameters);
            unset($foundRoute);
            unset($urlPath);
            unset($i);
            unset($pathPortions);

            return $result;
        }

        /*
         * (non-PHPdoc) @see \Spherus\Interfaces\IRouter::Initialize()
         */
        public function Initialize ()
        {
            self::RegisterDefaultRoute();
        }

        /* PRIVATE METHODS */

        /**
         * Registers default route
         */
        private function RegisterDefaultRoute ()
        {
            RouteManager::RegisterRoute(
                    new Route(\Config::getRoutingDefaults(), '/', 'main'));
        }

        /**
         *
         * @param string $url
         *            URL to parse
         * @throws SpherusException When default route not found.
         * @return Ambigous \Spherus\Routing\IRoute|NULL
         */
        private function GetRouteByUrl ($url)
        {
            $pathPortions = preg_split('/\//', $url, null, PREG_SPLIT_NO_EMPTY);
            $registeredRoutes = RouteManager::getRegisteredRoutes();

            foreach ($pathPortions as $pathPortion) {
                foreach ($registeredRoutes as $route) {
                    preg_match('/' . $pathPortion . '/', $route->getUrl(),
                            $match);
                    if ($match) {
                        return $route;
                    }
                }
            }

            if (! isset($foundRoute))             // trying to find default route
            {
                $foundRoute = RouteManager::GetRouteByName(
                        \Config::getRoutingDefaults());
                if (isset($foundRoute)) {
                    return $foundRoute;
                }
                throw new SpherusException(EXCEPTION_DEFAULT_ROUTE_NOT_FOUND);
            }

            return null;
        }
    }