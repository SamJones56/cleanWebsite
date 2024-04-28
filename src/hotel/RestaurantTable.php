<?php

namespace hotel;

final class RestaurantTable
{
    protected $table_id, $capacity;

    public function toRestaurantTableArray()
    {
        return array
        (
            'table_id' => $this->table_id,
            'capacity' => $this->capacity
        );
    }

    public function getTableId()
    {
        return $this->table_id;
    }

    public function setTableId($table_id): void
    {
        $this->table_id = $table_id;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }
}