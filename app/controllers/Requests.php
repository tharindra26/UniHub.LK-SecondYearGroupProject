<?php

require_once '../vendor/autoload.php';
class Requests extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->organizationModel = $this->model('Organization');
    $this->universityModel = $this->model('University');
    $this->eventModel = $this->model('Event');
    $this->postModel = $this->model('Post');
    $this->opportunityModel = $this->model('Opportunity');
    $this->notificationModel = $this->model('Notification');
    $this->statModel = $this->model('Stat');
  }

}