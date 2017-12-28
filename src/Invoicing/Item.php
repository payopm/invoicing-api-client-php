<?php

namespace Payopm\Invoicing;

/**
 * Invoice item.
 *
 * @author PAYOPM <dev@payopm.com>
 * @copyright 2017 PAYOPM
 * @since v1.0.0
 * @version v1.0.0
 * @package Payopm\Invoicing
 */
class Item
{
    /**
     * Name of the item.
     *
     * @var string
     */
    private $name;

    /**
     * Description of the item.
     *
     * @var string
     */
    private $description;

    /**
     * Quantity of the item.
     *
     * @var int|float
     */
    private $quantity;

    /**
     * Price of the item.
     *
     * @var float
     */
    private $price;

    public function __construct()
    {
        $this->quantity = 1;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float|int $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}