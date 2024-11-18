<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'recordSeqNumber',
        'reportingEntityID', 'reportingEntityIDType',
        'idOfMarketParticipant', 'idOfMarketParticipantType',
        'otherMarketParticipant', 'otherMarketParticipantType',
        'tradingCapacity', 'buySellIndicator', 'contractId', 'contractDate',
        'contractType', 'energyCommodity',
        'priceValue', 'priceCurrency', 'priceFormula',
        'estimatedNotionalAmountValue', 'estimatedNotionalAmountCurrency',
        'totalNotionalContractQuantityValue', 'totalNotionalContractQuantityUnit',
        'volumeOptionality', 'typeOfIndexPrice',
        'fixingIndex', 'fixingIndexType', 'fixingIndexSource',
        'firstFixingDate', 'lastFixingDate', 'fixingFrequency',
        'settlementMethod', 'deliveryPointOrZone',
        'deliveryStartDate', 'deliveryEndDate', 'loadType', 'actionType',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Правила валидации для всех полей
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'recordSeqNumber' => 'required|max_length[255]',
        'reportingEntityID' => 'required|max_length[255]',
        'reportingEntityIDType' => 'required|max_length[10]',
        'idOfMarketParticipant' => 'required|max_length[255]',
        'idOfMarketParticipantType' => 'required|max_length[10]',
        'otherMarketParticipant' => 'permit_empty|max_length[255]',
        'otherMarketParticipantType' => 'permit_empty|max_length[10]',
        'tradingCapacity' => 'required|max_length[1]',
        'buySellIndicator' => 'required|max_length[1]',
        'contractId' => 'required|max_length[100]',
        'contractDate' => 'required|valid_date',
        'contractType' => 'required|max_length[5]',
        'energyCommodity' => 'required|max_length[10]',
        'priceValue' => 'permit_empty|decimal|validateNumber[20,5]',
        'priceCurrency' => 'permit_empty|max_length[3]',
        'priceFormula' => 'permit_empty|string',
        'estimatedNotionalAmountValue' => 'permit_empty|decimal|validateNumber[20,5]',
        'estimatedNotionalAmountCurrency' => 'permit_empty|max_length[3]',
        'totalNotionalContractQuantityValue' => 'required|decimal|validateNumber[20,5]',
        'totalNotionalContractQuantityUnit' => 'required|max_length[6]',
        'volumeOptionality' => 'permit_empty|max_length[10]',
        'typeOfIndexPrice' => 'permit_empty|max_length[10]',
        'fixingIndex' => 'permit_empty|max_length[150]',
        'fixingIndexType' => 'permit_empty|max_length[5]',
        'fixingIndexSource' => 'permit_empty|max_length[150]',
        'firstFixingDate' => 'permit_empty|valid_date',
        'lastFixingDate' => 'permit_empty|valid_date',
        'fixingFrequency' => 'permit_empty|max_length[1]',
        'settlementMethod' => 'required|max_length[5]',
        'deliveryPointOrZone' => 'required|max_length[16]',
        'deliveryStartDate' => 'required|valid_date',
        'deliveryEndDate' => 'required|valid_date',
        'loadType' => 'permit_empty|max_length[2]',
        'actionType' => 'required|max_length[1]',
    ];
    protected $skipValidation = false;
}