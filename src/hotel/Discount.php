<?php

namespace hotel;

final class Discount
{
    protected $discount_id, $startDate, $endDate, $amount, $description;

    public function getDiscountArray(){
        return array(
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'amount' => $this->amount,
            'description' => $this->description
        );
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function getDiscountId()
    {
        return $this->discount_id;
    }

    public function setDiscountId($discount_id): void
    {
        $this->discount_id = $discount_id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }
}