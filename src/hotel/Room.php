<?php

namespace hotel;

class Room
{
    protected $room_id, $room_type, $accessibility, $price;

    public function toRoomArray()
    {
        return array
        (
            'room_id' => $this->room_id,
            'room_type' => $this->room_type,
            'accessibility' => $this->accessibility,
            'price' => $this->price
        );
    }

    public function getRoomId()
    {
        return $this->room_id;
    }

    public function setRoomId($room_id): void
    {
        $this->room_id = $room_id;
    }

    public function getRoomType()
    {
        return $this->room_type;
    }

    public function setRoomType($room_type): void
    {
        $this->room_type = $room_type;
    }

    public function getAccessibility()
    {
        return $this->accessibility;
    }

    public function setAccessibility($accessibility): void
    {
        $this->accessibility = $accessibility;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }


}