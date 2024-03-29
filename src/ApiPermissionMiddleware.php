<?php

namespace PHPMaker2023\project11;

use Slim\Routing\RouteContext;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Nyholm\Psr7\Factory\Psr17Factory;

/**
 * Permission middleware
 */
class ApiPermissionMiddleware
{
    // Handle slim request
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        global $UserProfile, $Security, $Language, $ResponseFactory;

        // Create Response
        $response = $ResponseFactory->createResponse();
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $args = $route->getArguments();
        $name = $route->getName(); // (api/action)
        $isCustom = $name == "custom";
        $ar = explode("/", $name);
        $action = @$ar[1];

        // Validate CSRF
        $checkTokenActions = [
            Config("API_JQUERY_UPLOAD_ACTION"),
            Config("API_SESSION_ACTION"),
            Config("API_EXPORT_CHART_ACTION"),
            Config("API_2FA_ACTION")
        ];
        if (Config("CHECK_TOKEN") && in_array($action, $checkTokenActions)) { // Check token
            if (!ValidateCsrf($request)) {
                return $response->withStatus(401); // Not authorized
            }
        }

        // Get route data
        $params = $args["params"] ?? ""; // Get route
        if ($isCustom && !EmptyValue($params)) { // Other API actions
            $ar = explode("/", $params);
            $action = array_shift($ar);
            $params = implode("/", $ar);
        }

        // Set up Route
        $routeValues = $params == "" ? [] : explode("/", $params);
        $GLOBALS["RouteValues"] = [$action, ...$routeValues];
        $index = $action == Config("API_EXPORT_ACTION") ? 1 : 0;
        $table = $isCustom ? "" : ($routeValues[$index] ?? Post(Config("API_OBJECT_NAME"))); // Get from route or Post

        // Set up request
        $GLOBALS["Request"] = $request;

        // Set up language
        $Language = Container("language");

        // Load Security
        $UserProfile = Container("profile");
        $Security = Container("security");

        // Default no permission
        $authorised = false;

        // Actions for table
        $apiTableActions = [
            Config("API_EXPORT_ACTION"),
            Config("API_LIST_ACTION"),
            Config("API_VIEW_ACTION"),
            Config("API_ADD_ACTION"),
            Config("API_EDIT_ACTION"),
            Config("API_DELETE_ACTION"),
            Config("API_FILE_ACTION")
        ];

        // Check permission
        if (
            in_array($action, $checkTokenActions) || // Token checked
            in_array($action, array_keys($GLOBALS["API_ACTIONS"])) || // Custom actions (deprecated)
            $action == Config("API_REGISTER_ACTION") || // Register
            $action == Config("API_PERMISSIONS_ACTION") && $request->getMethod() == "GET" || // Permissions (GET)
            $action == Config("API_PERMISSIONS_ACTION") && $request->getMethod() == "POST" && $Security->isAdmin() || // Permissions (POST)
            $action == Config("API_UPLOAD_ACTION") && $Security->isLoggedIn() || // Upload
            $action == Config("API_METADATA_ACTION") // Metadata
        ) {
            $authorised = true;
        } elseif (in_array($action, $apiTableActions) && $table != "") { // Table actions
            $Security->loadTablePermissions($table);
            $authorised = $action == Config("API_LIST_ACTION") && $Security->canList() ||
                $action == Config("API_EXPORT_ACTION") && $Security->canExport() ||
                $action == Config("API_VIEW_ACTION") && $Security->canView() ||
                $action == Config("API_ADD_ACTION") && $Security->canAdd() ||
                $action == Config("API_EDIT_ACTION") && $Security->canEdit() ||
                $action == Config("API_DELETE_ACTION") && $Security->canDelete() ||
                $action == Config("API_FILE_ACTION") && ($Security->canList() || $Security->canView());
        } elseif ($action == Config("API_EXPORT_ACTION") && EmptyValue($table)) { // Get exported file
            $authorised = true; // Check table permission in ExportHandler.php
        } elseif ($action == Config("API_LOOKUP_ACTION")) { // Lookup
            $canLookup = function ($params) use ($Security) {
                $object = $params[Config("API_LOOKUP_PAGE")]; // Get lookup page
                $page = Container($object);
                if ($page !== null) {
                    $fieldName = $params[Config("API_FIELD_NAME")]; // Get field name
                    $lookupField = $page->Fields[$fieldName] ?? null;
                    if ($lookupField) {
                        $lookup = $lookupField->Lookup;
                        if ($lookup) {
                            $tbl = $lookup->getTable();
                            if ($tbl) {
                                $Security->loadTablePermissions($tbl->TableVar);
                                return $Security->canLookup();
                            }
                        }
                    }
                }
            };
            if ($request->getContentType() == "application/json") { // Multiple lookup requests in JSON
                $parsedBody = $request->getParsedBody();
                if (is_array($parsedBody)) {
                    $authorised = ArraySome($canLookup, $parsedBody);
                }
            } else { // Single lookup request
                $authorised = $canLookup($request->getParams());
            }
        } elseif ($action == Config("API_PUSH_NOTIFICATION_ACTION")) { // Push notification
            $parm = count($routeValues) >= 1 ? $routeValues[0] : null;
            if ($parm == Config("API_PUSH_NOTIFICATION_SUBSCRIBE") || $parm == Config("API_PUSH_NOTIFICATION_DELETE")) {
                $authorised = Config("PUSH_ANONYMOUS") || $Security->isLoggedIn();
            } elseif ($parm == Config("API_PUSH_NOTIFICATION_SEND")) {
                $Security->loadTablePermissions(Config("SUBSCRIPTION_TABLE"));
                $authorised = $Security->canPush();
            }
        } elseif ($action == Config("API_2FA_ACTION")) { // Two factor authentication
            $parm = count($routeValues) >= 1 ? $routeValues[0] : null;
            if ($parm == Config("API_2FA_SHOW")) {
                $authorized = true;
            } elseif ($action == Config("API_2FA_VERIFY")) {
                $authorized = $Security->isLoggingIn2FA();
            } elseif ($action == Config("API_2FA_RESET")) {
                $authorized = $Security->IsSysAdmin();
            } elseif ($action == Config("API_2FA_BACKUP_CODES") || $action == Config("API_2FA_NEW_BACKUP_CODES")) {
                $authorized = $Security->isLoggedIn() && !$Security->isSysAdmin();
            } elseif ($action == Config("API_2FA_SEND_OTP")) {
                $authorized = $Security->isLoggingIn2FA() && !$Security->isSysAdmin();
            }
        }
        if (!$authorised) {
            return $response->withStatus(401); // Not authorized
        }

        // Handle request
        return $handler->handle($request);
    }
}
