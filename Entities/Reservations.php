<?php

namespace workshop_platform\Entities;

class Reservations {
    private $id;
    private $user_id;
    private $workshop_id;
    private $reservation_date;
    private $status;

    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->user_id;
    }
    public function getWorkshopId() {
        return $this->workshop_id;
    }
    public function getReservationDate() {
        return $this->reservation_date;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    public function setWorkshopId($workshop_id) {
        $this->workshop_id = $workshop_id;
    }
    public function setReservationDate($reservation_date) {
        $this->reservation_date = $reservation_date;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
}