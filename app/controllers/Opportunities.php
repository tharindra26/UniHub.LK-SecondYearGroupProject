<?php
class Opportunities extends Controller
{
public function index()
  {
    // $events= $this->eventModel->getEvents();
    $data = [
      // 'events'=> $events
    ];

    $this->view('opportunities/opportunities-index', $data);
  }
}