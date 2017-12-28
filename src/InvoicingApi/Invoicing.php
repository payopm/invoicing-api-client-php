<?php

namespace Payopm\InvoicingApi;

use Payopm\AddressBook\Contact;
use Payopm\Invoicing\Invoice;

/**
 * PAYOPM invoicing API layer.
 *
 * @author PAYOPM <dev@payopm.com>
 * @copyright 2017 PAYOPM
 * @since v1.0.0
 * @version v1.0.1
 * @package Payopm\InvoicingApi
 */
class Invoicing
{
    /**
     * PAYOPM API endpoint. DO NOT MODIFY THIS VALUE.
     */
    const API_ENDPOINT = 'https://www.payopm.com/api';

    /**
     * User ID
     *
     * @var string
     */
    private $userId;

    /**
     * PAYOPM Username
     *
     * @var string
     */
    private $username;

    /**
     * API key
     *
     * @var string
     */
    private $apiKey;

    /**
     * Invoicing constructor. Can be initialized with the API credentials.
     *
     * @param string $userId
     * @param string $username
     * @param string $apiKey
     */
    public function __construct($userId = null, $username = null, $apiKey = null)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * Creates a new address book
     *
     * @see Invoicing::call() For the exceptions thrown and API calling structure.
     *
     * @since 1.0.0
     * @param string $name Name of the address book.
     */
    public function createAddressBook($name)
    {
        $this->call('rest/addressbook/create', array(), array('address_book_name' => $name));
    }

    /**
     * Retrieve the name of the address books in the PAYOPM account.
     *
     * @see Invoicing::call() For the exceptions thrown and API calling structure.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function listAddressBooks()
    {
        $apiResult = $this->call('rest/addressbook/list');
        return $apiResult->data;
    }

    /**
     * Retrieve a contact given the email address.
     *
     * @see Invoicing::call() For the exceptions thrown and API calling structure.
     *
     * @since 1.0.0
     * @param $email
     *
     * @return \stdClass
     */
    public function getContact($email)
    {
        $apiResult = $this->call('rest/contact/search', array(), array('contact_email' => $email));
        return $apiResult->data;
    }

    /**
     * Retrieve all contacts.
     *
     * @see Invoicing::call() For the exceptions thrown and API calling structure.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function listContacts()
    {
        $apiResult = $this->call('rest/contact/list');
        return $apiResult->data;
    }

    /**
     * Creates a contact.
     *
     * @see Invoicing::call() For the exceptions thrown and API calling structure.
     *
     * @since 1.0.0
     * @param Contact $contact
     */
    public function createContact(Contact $contact)
    {
        $this->call('rest/contact/create', array(), array(

            'first_name' => $contact->getFirstName(),
            'last_name' => $contact->getLastName(),
            'email' => $contact->getEmail(),
            'business_name' => $contact->getBusinessName(),
            'country' => $contact->getCountry(),
            'address_line_1' => $contact->getAddressLine1(),
            'address_line_2' => $contact->getAddressLine2(),
            'city' => $contact->getCity(),
            'state' => $contact->getState(),
            'postal_code' => $contact->getPostalCode(),
            'address_book' => $contact->getAddressBookName()

        ));
    }

    /**
     * Register an invoice
     *
     * @since 1.0.0
     * @param Invoice $invoice
     *
     * @return int
     */
    public function registerInvoice(Invoice $invoice)
    {
        $preInvoice = array(
            'customer_id' => $invoice->getCustomerId(),
            'reference' => $invoice->getReference(),
            'recipient_email' => $invoice->getRecipient(),
            'invoiceDate' => (null != $invoice->getInvoiceDate()) ? $invoice->getInvoiceDate()->format('Y-m-d') : null,
            'paymentDate' => (null != $invoice->getPaymentDate()) ? $invoice->getPaymentDate()->format('Y-m-d') : null,
            'payment_term' => $invoice->getPaymentTerm(),
            'currency' => $invoice->getCurrency(),
            'general_terms' => $invoice->getGeneralTerms(),
            'recipient_note' => $invoice->getRecipientNote()
        );
        $preItems = array();
        $items = $invoice->getItems();
        for($i = 0; $i < count($items); $i++) {
            $preItems[$i] = array(
                'name' => $items[$i]->getName(),
                'description' => $items[$i]->getDescription(),
                'quantity' => $items[$i]->getQuantity(),
                'price' => $items[$i]->getPrice()
            );
        }
        $preInvoice['items'] = $preItems;
        $apiResult = $this->call('rest/invoice/create', array(), $preInvoice);
        return $apiResult->data->invoice_number;
    }

    /**
     * Get the PDF stream of the invoice.
     *
     * @since 1.0.0
     * @param $invoiceNumber
     *
     * @return string
     */
    public function getInvoice($invoiceNumber)
    {
        return $this->call('invoice/download', array(), array('invoice' => $invoiceNumber));
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return Invoicing
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Invoicing
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Invoicing
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Call the API with the given parameters
     *
     * @since 1.0.0
     * @param string $function URL to call
     * @param array $query QUERY part of the URL.
     * @param array $data POST part of the URL.
     * @param array $urlReplacements Replacements to make in the function part of the URL.
     *
     * @throws InternalErrorException thrown when the PAOYPM server return an HTTP 500 error
     * @throws AccessDeniedException thrown when the call is not authorized to run, bad credentials provided or some funcitonal error. See message for more details.
     * @throws BadResponseException thrown when the server answer with a non-JSON response. Debug for more details.
     * @throws NotImplementedException thrown when the function return a non-OK HTTP response and it is undocumented.
     *
     * @return \stdClass|string
     */
    private function call($function, $query = array(), $data = array(), $urlReplacements = array())
    {
        $apiUrl = sprintf("%s/%s", self::API_ENDPOINT, $function);
        if (0 < count($urlReplacements)) {
            foreach ($urlReplacements as $replacement => $replacementValue) {
                $apiUrl = str_replace($replacement, $replacementValue, $apiUrl);
            }
        }
        if (0 < count($query)) {
            $apiUrl .= '?' . http_build_query($query);
        }
        $data = array_merge($data, array(
            'user_id' => $this->userId,
            'username' => $this->username,
            'api_key' => $this->apiKey
        ));
        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, array(

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data)

        ));
        if(!preg_match('/^rest/', $function)) {
            curl_setopt_array($ch, array(
                CURLOPT_HEADER => 1,
                CURLOPT_BINARYTRANSFER => 1
            ));
        }
        $chResult = curl_exec($ch);
        if(500 === curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            throw new InternalErrorException('The request can\'t be completed');
        }
        $apiResponse = null;
        if(preg_match('/^rest/', $function)) {
            if (false === ($apiResponse = json_decode($chResult))) {
                throw new BadResponseException('Received a bad or uncomprensible response from the server!');
            }
        } else {
            $apiResponse = $chResult;
        }
        if(403 === curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            throw new AccessDeniedException(sprintf('Access denied: %s', ($apiResponse instanceof \stdClass) ? $apiResponse->message : 'You don\'t have access to this resource'));
        }
        if(200 !== curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
            throw new NotImplementedException('This function is not implemented yet');
        }
        return $apiResponse;
    }
}