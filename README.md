FreshmailBundle
===============

Łatwe odpytywanie usług FreshMail (http://freshmail.pl) w formie bundla dla symfonii 2

Biblioteczka bazuje na kodzie z:
https://github.com/FreshMail/REST-API

INSTALACJA
==========


KONFIGURACJA
============

W config.yml wymagana jest konfiguracja dla bundla:

qbitz_freshmail:
    buzz_client:          ~ # One of "curl"; "file_get_contents"
    buzz_timeout:         5
    api_key:              null # Required
    api_secret:           null # Required
    host:                 'https://app.freshmail.pl/'
    prefix:               rest/

WYNORZYSTANIE
=============

$arrayResponse = $browser->doRequest($url, $data);

gdzie url to url do usługi FreshMail, np.: 'ping', 'subscriber/add' (info na http://freshmail.pl/developer-api/autoryzacja/), a data to tablica zmiennych wysyłanych w żądaniu.

Przykłady:

$browser->doRequest('ping');
$browser->doRequest('subscriber/add', array( 'email'=>'kalapucka@example.com', 'list'=>'hashyhash', 'state'=>1 ));
