<?php
class Notification
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addNotification($data)
    {
        $query = 'INSERT INTO user_notifications(
            notification_from,
            notification_type,
            user_id,
            notification_text)
            VALUES(:notification_from, :notification_type, :user_id, :notification_text)';

        $this->db->query($query);

        $this->db->bind(':notification_from', $data['notification_from']);
        $this->db->bind(':notification_type', $data['notification_type']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':notification_text', $data['notification_text']);

        if ($this->db->execute()) {
            return true;
        }

    }
}