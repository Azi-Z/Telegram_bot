<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope(Google_Service_Calendar::CALENDAR_READONLY); // added now 
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR_READONLY)
));                                           // added now
  


if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new  Google_Service_Calendar($client); // added now
        $calendarId = 'primary';
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  'timeMin' => date('c'),
		);
		$results = $drive->events->listEvents($calendarId, $optParams);  // changed $service to $drive

		if (count($results->getItems()) == 0) {
		  print "No upcoming events found.\n";
		} else {
		  print "Upcoming events:\n";
		  foreach ($results->getItems() as $event) {
		    $start = $event->start->dateTime;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    printf("%s (%s)\n", $event->getSummary(), $start);
		  }
		}                                               // upto here
  // $drive = new Google_Service_Drive($client);
  // $files = $drive->files->listFiles(array())->getFiles();
  // echo json_encode($files);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/new/php-oauth2-example/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

?>