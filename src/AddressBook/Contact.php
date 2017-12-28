<?php

namespace Payopm\AddressBook;

/**
 * Contact
 *
 * @author PAYOPM <dev@payopm.com>
 * @copyright 2017 PAYOPM
 * @since v1.0.0
 * @version v1.0.0
 * @package Payopm\AddressBook
 */
class Contact
{
    /**
     * First name
     *
     * @var string
     */
    private $firstName;

    /**
     * Last name
     *
     * @var string
     */
    private $lastName;

    /**
     * E-mail
     *
     * @var string
     */
    private $email;

    /**
     * Business name
     *
     * @var string
     */
    private $businessName;

    /**
     * 2-digit country code
     *
     * @var string
     */
    private $country;

    /**
     * Address line 1
     *
     * @var string
     */
    private $addressLine1;

    /**
     * Address line 2
     *
     * @var string
     */
    private $addressLine2;

    /**
     * City
     *
     * @var string
     */
    private $city;

    /**
     * State
     *
     * @var string
     */
    private $state;

    /**
     * Postal code
     *
     * @var string
     */
    private $postalCode;

    /**
     * Address book name
     *
     * @var string
     */
    private $addressBookName;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * @param string $businessName
     * @return Contact
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Contact
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     * @return Contact
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param string $addressLine2
     * @return Contact
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Contact
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Contact
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressBookName()
    {
        return $this->addressBookName;
    }

    /**
     * @param string $addressBookName
     * @return Contact
     */
    public function setAddressBookName($addressBookName)
    {
        $this->addressBookName = $addressBookName;
        return $this;
    }
}