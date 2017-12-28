<?php

namespace Payopm\Invoicing;

/**
 * PAYOPM invoice schema
 *
 * @author PAYOPM <dev@payopm.com>
 * @copyright 2017 PAYOPM
 * @since v1.0.0
 * @version v1.0.0
 * @package Payopm\Invoicing
 */
class Invoice
{
    const PAYMENT_TERMS_DUE_ON_RECEIPT = 2010;
    const PAYMENT_TERMS_DUE_ON_DATE = 2020;
    const PAYMENT_TERMS_NO_DUE = 2030;
    const PAYMENT_TERMS_NET10 = 2041;
    const PAYMENT_TERMS_NET15 = 2042;
    const PAYMENT_TERMS_NET30 = 2043;
    const PAYMENT_TERMS_NET45 = 2044;

    /**
     * Read-only. Number of the invoice (PAYOPM invoicing numeration).
     *
     * @var int
     */
    private $number;

    /**
     * Customer ID.
     * It can be the customer's own numeration
     *
     * @var string
     */
    private $customerId;

    /**
     * Optional. It can be the customer's reference for the payment
     *
     * @var string
     */
    private $reference;

    /**
     * E-mail of the recipient. It must be already registered in any address book of the PAYOPM account.
     *
     * @var string
     */
    private $recipient;

    /**
     * Invoice date.
     *
     * @var \DateTime
     */
    private $invoiceDate;

    /**
     * Optional. Payment date.
     *
     * @var \DateTime
     */
    private $paymentDate;

    /**
     * Payment Term. Any of the PAYMENT_TERM_* constants value.
     *
     * @var int
     */
    private $paymentTerm;

    /**
     * Currency of the invoice. Only EUR ans USD can be used.
     *
     * @var
     */
    private $currency;

    /**
     * Optional. General terms.
     *
     * @var string
     */
    private $generalTerms;

    /**
     * Recipient note
     *
     * @var string
     */
    private $recipientNote;

    /**
     * Items
     *
     * @var array
     */
    private $items;

    public function __construct()
    {
        $this->items = array();
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     * @return Invoice
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Invoice
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return Invoice
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * @param \DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * @param \DateTime $paymentDate
     * @return Invoice
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentTerm()
    {
        return $this->paymentTerm;
    }

    /**
     * @param int $paymentTerm
     * @return Invoice
     */
    public function setPaymentTerm($paymentTerm)
    {
        $this->paymentTerm = $paymentTerm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return Invoice
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getGeneralTerms()
    {
        return $this->generalTerms;
    }

    /**
     * @param string $generalTerms
     * @return Invoice
     */
    public function setGeneralTerms($generalTerms)
    {
        $this->generalTerms = $generalTerms;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientNote()
    {
        return $this->recipientNote;
    }

    /**
     * @param string $recipientNote
     * @return Invoice
     */
    public function setRecipientNote($recipientNote)
    {
        $this->recipientNote = $recipientNote;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return Invoice
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }
}