<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This class corresponds to database table mailservicedata
 * Class MailServiceData
 * @package App
 */
class MailServiceData extends Model
{
    protected $table = 'mailservicedata';
    public $primaryKey = 'id';
    private $subject;
    private $employeeName;
    private $customerName;
    private $customerEmail;
    private $estimatedWeight;
    private $costPerPound;
    private $originSurcharge;
    private $origin;
    private $destination;
    private $destinationSurcharge;
    private $selectStorageDuration;
    private $optradio;
    private $movingdate1;
    private $movingdate2;
    private $leadInfo;

    function getLeadInfo()
    {
        return $this->leadInfo;
    }

    function setLeadInfo($leadInfo)
    {
        $this->leadInfo = $leadInfo;
    }

    function getMovingdate1()
    {
        return $this->movingdate1;
    }

    function setMovingdate1($movingdate1)
    {
        $this->movingdate1 = $movingdate1;
    }

    function getMovingdate2()
    {
        return $this->movingdate2;
    }

    function setMovingdate2($movingdate2)
    {
        $this->movingdate2 = $movingdate2;
    }

    function getSubject()
    {
        return $this->subject;
    }

    function setSubject($subject)
    {
        $this->subject = $subject;
    }

    function getEmployeeName()
    {
        return $this->employeeName;
    }

    function getUserId()
    {
        return $this->userId;
    }

    function setUserId($userId)
    {
        $this->userId = $userId;
    }

    function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    function getCustomerName()
    {
        return $this->customerName;
    }


    function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    function getEstimatedWeight()
    {
        return $this->estimatedWeight;
    }

    function setEstimatedWeight($estimatedWeight)
    {
        $this->estimatedWeight = $estimatedWeight;
    }

    function getCostPerPound()
    {
        return $this->costPerPound;
    }

    function setCostPerPound($costPerPound)
    {
        $this->costPerPound = $costPerPound;
    }

    function getOriginSurcharge()
    {
        return $this->originSurcharge;
    }

    function setOriginSurcharge($originSurcharge)
    {
        $this->originSurcharge = $originSurcharge;
    }

    function getOrigin()
    {
        return $this->origin;
    }

    function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    function getDestination()
    {
        return $this->destination;
    }

    function setDestination($destination)
    {
        $this->destination = $destination;
    }

    function getDestinationSurcharge()
    {
        return $this->destinationSurcharge;
    }


    function setDestinationSurcharge($destinationSurcharge)
    {
        $this->destinationSurcharge = $destinationSurcharge;
    }

    function getSelectStorageDuration()
    {
        return $this->selectStorageDuration;
    }

    function setSelectStorageDuration($selectStorageDuration)
    {
        $this->selectStorageDuration = $selectStorageDuration;
    }

    function getOptradio()
    {
        return $this->optradio;
    }

    function setOptradio($optradio)
    {
        $this->optradio = $optradio;
    }

}
