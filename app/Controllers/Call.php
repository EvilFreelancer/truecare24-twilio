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
        $userPhone = preg_replace('!\d+!', '', $params['userPhone']);

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
                getenv('TWILIO_NUMBER_ADMIN'),  // Call to this number
                getenv('TWILIO_NUMBER'),        // From a valid Twilio number
                ['url' => getenv('TWILIO_OUTBOUND_URL') . '/' . $userPhone]
            );
        } catch (TwilioException $e) {
            return $e;
        }

        // return a JSON response
        return ['message' => 'Call incoming!'];
    }

    /**
     * Make outbound call
     *
     * @param   Request $request
     * @param   Response $response
     * @param   array $args
     * @return  Response|TwilioException
     */
    public function outbound(Request $request, Response $response, array $args)
    {
        // Get form input
        $userPhone = getenv('TWILIO_NUMBER');

        // A message for Twilio's TTS engine to repeat
        $sayMessage = 'Thanks for contacting our sales department.
            Our next available representative will take your call.';

        // Then generate XML in which we describe what need call to client
        try {
            $twiml = new \Twilio\Twiml();
            $twiml->say($sayMessage, ['voice' => 'alice']);
            $twiml->dial($userPhone);
        } catch (TwilioException $e) {
            return $e;
        }

        // Generate stream for response with xml
        $resources = tmpfile();
        fwrite($resources, $twiml);
        $stream = new Stream($resources);

        return $response
            ->withBody($stream)
            ->withStatus(200)
            ->withHeader('Content-Type', 'text/xml');
    }

}
