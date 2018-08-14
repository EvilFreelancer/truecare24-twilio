<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Stream;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;

class Call
{
    /**
     * @var \Slim\Views\PhpRenderer
     */
    public $view;

    /**
     * Call constructor.
     */
    public function __construct()
    {
        // Can be moved to parent class
        $this->view = new \Slim\Views\PhpRenderer(__DIR__ . '/../Views/');
    }

    /**
     * Show index page of application
     *
     * @param   Request $request
     * @param   Response $response
     * @return  Response
     */
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'home.php');
    }

    /**
     * Add call into the Twilio account
     *
     * @param   Request $request
     * @param   Response $response
     * @return  array|TwilioException|ConfigurationException
     */
    public function call(Request $request, Response $response)
    {
        // Read parameters of request
        $params = $request->getParsedBody();

        // Get form input
        $userPhone = urlencode(str_replace(' ', '', $params['userPhone']));

        try {
            // Create authenticated REST client using account credentials from environment
            $client = new \Twilio\Rest\Client(
                getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN')
            );
        } catch (ConfigurationException $e) {
            return $e;
        }

        // On first step we need call the admin
        try {
            $client->calls->create(
                $userPhone, // Call to this number
                getenv('TWILIO_NUMBER'), // From a valid Twilio number
                ['url' => 'http://demo.twilio.com/docs/voice.xml']
            );
        } catch (TwilioException $e) {
            return $e;
        }

        // return a JSON response
        return ['message' => 'Call incoming!'];
    }

}
