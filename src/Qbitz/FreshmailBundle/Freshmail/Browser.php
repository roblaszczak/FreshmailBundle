<?php

namespace Qbitz\FreshmailBundle\Freshmail;

class Browser {

  private $buzzBrowser;

  private $apiKey;
  private $apiSecret;
  private $host;
  private $prefix;

  public function __construct(\Buzz\Browser $buzzBrowser, $apiKey, $apiSecret, $host, $prefix) {
    $this->buzzBrowser = $buzzBrowser;

    $this->buzzBrowser->getClient()->setOption(CURLOPT_SSL_VERIFYPEER, false);

    $this->apiKey = $apiKey;
    $this->apiSecret = $apiSecret;
    $this->host = $host;
    $this->prefix = $prefix;
  }

  public function doRequest($url, array $params = array()) {

    if (empty($params)) {
      $postData = '';
    }
    else {
      $postData = json_encode( $params );
    }

    $sign = sha1( $this->apiKey . '/' . $this->prefix . $url . $postData . $this->apiSecret );

    if($postData) {
      $request = new \Buzz\Message\Request('POST', $this->prefix.$url, $this->host);
      $request->setContent($postData);
    }
    else {
      $request = new \Buzz\Message\Request('GET', $this->prefix.$url, $this->host);
    }

    $request->setHeaders(array(
      'X-Rest-ApiKey' => $this->apiKey,
      'X-Rest-ApiSign' => $sign,
      'Content-Type' => 'application/json'
    ));

    $response = new \Buzz\Message\Response();
    $this->buzzBrowser->send($request, $response);

    $responseData = json_decode( $response->getContent(), true );

    if (!$response->isOk()) {
      $errors = $responseData['errors'];
      if (is_array($errors)) {
        foreach ($errors as $e) {
          throw new RestException($e['message'], $e['code']);
        }
      }
    }

    if (is_array($responseData) == false) {
      throw new \Exception('Invalid json response');
    }

    return $responseData;
  }

}
