<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TestMigration extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'recordSeqNumber' => ['type' => 'VARCHAR', 'constraint' => 255],

            'reportingEntityID' => ['type' => 'VARCHAR', 'constraint' => 255], //группа reportingEntityID
            'reportingEntityIDType' => ['type' => 'CHAR', 'constraint' => 10],

            'idOfMarketParticipant' => ['type' => 'VARCHAR', 'constraint' => 255], //группа idOfMarketParticipant
            'idOfMarketParticipantType' => ['type' => 'CHAR', 'constraint' => 10],

            'otherMarketParticipant' => ['type' => 'VARCHAR', 'constraint' => 255], //группа otherMarketParticipant
            'otherMarketParticipantType' => ['type' => 'CHAR', 'constraint' => 10],

            'tradingCapacity' => ['type' => 'CHAR', 'constraint' => 1],
            'buySellIndicator' => ['type' => 'CHAR', 'constraint' => 1],
            'contractId' => ['type' => 'VARCHAR', 'constraint' => 100],
            'contractDate' => ['type' => 'DATE'],
            'contractType' => ['type' => 'CHAR', 'constraint' => 5],
            'energyCommodity' => ['type' => 'CHAR', 'constraint' => 10],

            'priceValue' => ['type' => 'DECIMAL', 'null' => true], //группа priceOrPriceFormula выводится price или priceFormula
            'priceCurrency' => ['type' => 'CHAR', 'constraint' => 3, 'null' => true],
            'priceFormula' => ['type' => 'TEXT', 'null' => true],

            'estimatedNotionalAmountValue' => ['type' => 'DECIMAL', 'null' => true], //группа estimatedNotionalAmount
            'estimatedNotionalAmountCurrency' => ['type' => 'CHAR', 'constraint' => 3, 'null' => true],

            'totalNotionalContractQuantityValue' => ['type' => 'DECIMAL'], //группа totalNotionalContractQuantity
            'totalNotionalContractQuantityUnit' => ['type' => 'CHAR', 'constraint' => 6],

            'volumeOptionality' => ['type' => 'CHAR', 'constraint' => 10],
            'typeOfIndexPrice' => ['type' => 'CHAR', 'constraint' => 10, 'null' => true],

            'fixingIndex' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true], //группа fixingIndexDetails
            'fixingIndexType' => ['type' => 'CHAR', 'constraint' => 5, 'null' => true],
            'fixingIndexSource' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'firstFixingDate' => ['type' => 'DATE', 'null' => true],
            'lastFixingDate' => ['type' => 'DATE', 'null' => true],
            'fixingFrequency' => ['type' => 'CHAR', 'constraint' => 1, 'null' => true],

            'settlementMethod' => ['type' => 'CHAR', 'constraint' => 5],
            'deliveryPointOrZone' => ['type' => 'CHAR', 'constraint' => 16],
            'deliveryStartDate' => ['type' => 'DATE'],
            'deliveryEndDate' => ['type' => 'DATE'],
            'loadType' => ['type' => 'CHAR', 'constraint' => 2, 'null' => true],
            'actionType' => ['type' => 'CHAR', 'constraint' => 1],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('test');
    }

    public function down(): void
    {
        $this->forge->dropTable('test');
    }
}
