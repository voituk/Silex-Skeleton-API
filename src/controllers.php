<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
		return $app->json(array(
			'code' => 0, 
			'message' => 'OK',
		));
})
->bind('homepage')
;

/**
 * Configure error handler
 */
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return null;
    }
    $message = 'We are sorry, but something went terribly wrong.';

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
    }

    return $app->json(array(
        'code'    => $code,
        'message' => $message
    ), $code);
});

