<?php


namespace workshop_platform\Entities;

class Workshops {
    private ?int $id_workshop = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $event_date = null;
    private ?int $total_places = null;
    private ?int $available_places = null;
    private ?int $id_category = null;

    public function getIdWorkshop(): ?int {
        return $this->id_workshop;
    }

    public function setIdWorkshop(int $id_workshop): self {
        $this->id_workshop = $id_workshop;
        return $this;
    }






    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }







    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;
        return $this;
    }







    public function getEventDate(): ?string {
        return $this->event_date;
    }

    public function setEventDate(string $event_date): self {
        $this->event_date = $event_date;
        return $this;
    }







    public function getTotalPlaces(): ?int {
        return $this->total_places;
    }

    public function setTotalPlaces(int $total_places): self {
        $this->total_places = $total_places;
        return $this;
    }







    public function getAvailablePlaces(): ?int {
        return $this->available_places;
    }

    public function setAvailablePlaces(int $available_places): self {
        $this->available_places = $available_places;
        return $this;
    }






    
    public function getIdCategory(): ?int {
        return $this->id_category;
    }

    public function setIdCategory(int $id_category): self {
        $this->id_category = $id_category;
        return $this;
    }
}