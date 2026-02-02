<?php

namespace workshop_platform\Entities;

class Reservations {
    private ?int $id_reservation = null;
    private ?string $reservation_date = null;
    private ?int $id_user = null;
    private ?int $id_workshop = null;

    public function getIdReservation(): ?int {
        return $this->id_reservation;
    }

    public function setIdReservation(int $id_reservation): self {
        $this->id_reservation = $id_reservation;
        return $this;
    }

    public function getReservationDate(): ?string {
        return $this->reservation_date;
    }

    public function setReservationDate(string $reservation_date): self {
        $this->reservation_date = $reservation_date;
        return $this;
    }

    public function getIdUser(): ?int {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self {
        $this->id_user = $id_user;
        return $this;
    }

    public function getIdWorkshop(): ?int {
        return $this->id_workshop;
    }

    public function setIdWorkshop(int $id_workshop): self {
        $this->id_workshop = $id_workshop;
        return $this;
    }
}