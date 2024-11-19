<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($test) ? 'Редактировать запись' : 'Создать новую запись' ?></title>
</head>
<body>

<h1><?= isset($test) ? 'Редактировать запись' : 'Создать новую запись' ?></h1>

<?php if (session()->getFlashdata('errors')) : ?>
    <ul style="color: red;">
        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif; ?>

<form action="<?= isset($test) ? site_url('/test/update/'.$test['id']) : site_url('/test/store') ?>" method="post">

    <p>
        <a href="<?= site_url('test') ?>">Index</a> / Form
    </p>

    <?= csrf_field() ?>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= old('name', $test['name'] ?? '') ?>" required>
    <br>

    <label for="recordSeqNumber">RecordSeqNumber:</label>
    <input type="text" name="recordSeqNumber" id="recordSeqNumber" value="<?= old('recordSeqNumber', $test['recordSeqNumber'] ?? '') ?>" required>
    <br>

    <label for="reportingEntityID">Reporting Entity ID:</label>
    <input type="text" name="reportingEntityID" id="reportingEntityID" value="<?= old('reportingEntityID', $test['reportingEntityID'] ?? '') ?>" required>
    <br>

    <label for="reportingEntityIDType">Reporting Entity ID Type:</label>
    <select name="reportingEntityIDType" id="reportingEntityIDType" required>
        <option value="" disabled <?= !isset($test['reportingEntityIDType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="ace" <?= old('reportingEntityIDType', $test['reportingEntityIDType'] ?? '') == 'ace' ? 'selected' : '' ?>>ACE</option>
        <option value="lei" <?= old('reportingEntityIDType', $test['reportingEntityIDType'] ?? '') == 'lei' ? 'selected' : '' ?>>LEI</option>
        <option value="bic" <?= old('reportingEntityIDType', $test['reportingEntityIDType'] ?? '') == 'bic' ? 'selected' : '' ?>>BIC</option>
        <option value="eic" <?= old('reportingEntityIDType', $test['reportingEntityIDType'] ?? '') == 'eic' ? 'selected' : '' ?>>EIC</option>
        <option value="gln" <?= old('reportingEntityIDType', $test['reportingEntityIDType'] ?? '') == 'gln' ? 'selected' : '' ?>>GLN</option>
    </select>
    <br>

    <label for="idOfMarketParticipant">ID of Market Participant:</label>
    <input type="text" name="idOfMarketParticipant" id="idOfMarketParticipant" value="<?= old('idOfMarketParticipant', $test['idOfMarketParticipant'] ?? '') ?>" required>
    <br>

    <label for="idOfMarketParticipantType">ID of Market Participant Type:</label>
    <select name="idOfMarketParticipantType" id="idOfMarketParticipantType" required>
        <option value="" disabled <?= !isset($test['idOfMarketParticipantType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="ace" <?= old('idOfMarketParticipantType', $test['idOfMarketParticipantType'] ?? '') == 'ace' ? 'selected' : '' ?>>ACE</option>
        <option value="lei" <?= old('idOfMarketParticipantType', $test['idOfMarketParticipantType'] ?? '') == 'lei' ? 'selected' : '' ?>>LEI</option>
        <option value="bic" <?= old('idOfMarketParticipantType', $test['idOfMarketParticipantType'] ?? '') == 'bic' ? 'selected' : '' ?>>BIC</option>
        <option value="eic" <?= old('idOfMarketParticipantType', $test['idOfMarketParticipantType'] ?? '') == 'eic' ? 'selected' : '' ?>>EIC</option>
        <option value="gln" <?= old('idOfMarketParticipantType', $test['idOfMarketParticipantType'] ?? '') == 'gln' ? 'selected' : '' ?>>GLN</option>
    </select>
    <br>

    <label for="otherMarketParticipant">Other Market Participant:</label>
    <input type="text" name="otherMarketParticipant" id="otherMarketParticipant" value="<?= old('otherMarketParticipant', $test['otherMarketParticipant'] ?? '') ?>" required>
    <br>

    <label for="otherMarketParticipantType">Other Market Participant Type:</label>
    <select name="otherMarketParticipantType" id="otherMarketParticipantType" required>
        <option value="" disabled <?= !isset($test['otherMarketParticipantType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="ace" <?= old('otherMarketParticipantType', $test['otherMarketParticipantType'] ?? '') == 'ace' ? 'selected' : '' ?>>ACE</option>
        <option value="lei" <?= old('otherMarketParticipantType', $test['otherMarketParticipantType'] ?? '') == 'lei' ? 'selected' : '' ?>>LEI</option>
        <option value="bic" <?= old('otherMarketParticipantType', $test['otherMarketParticipantType'] ?? '') == 'bic' ? 'selected' : '' ?>>BIC</option>
        <option value="eic" <?= old('otherMarketParticipantType', $test['otherMarketParticipantType'] ?? '') == 'eic' ? 'selected' : '' ?>>EIC</option>
        <option value="gln" <?= old('otherMarketParticipantType', $test['otherMarketParticipantType'] ?? '') == 'gln' ? 'selected' : '' ?>>GLN</option>
    </select>
    <br>

    <label for="tradingCapacity">Trading Capacity:</label>
    <select name="tradingCapacity" id="tradingCapacity" required>
        <option value="" disabled <?= !isset($test['tradingCapacity']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="P" <?= old('tradingCapacity', $test['tradingCapacity'] ?? '') == 'P' ? 'selected' : '' ?>>P</option>
        <option value="A" <?= old('tradingCapacity', $test['tradingCapacity'] ?? '') == 'A' ? 'selected' : '' ?>>A</option>
    </select>
    <br>

    <label for="buySellIndicator">Buy/Sell Indicator:</label>
    <select name="buySellIndicator" id="buySellIndicator" required>
        <option value="" disabled <?= !isset($test['buySellIndicator']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="B" <?= old('buySellIndicator', $test['buySellIndicator'] ?? '') == 'B' ? 'selected' : '' ?>>B</option>
        <option value="S" <?= old('buySellIndicator', $test['buySellIndicator'] ?? '') == 'S' ? 'selected' : '' ?>>S</option>
        <option value="C" <?= old('buySellIndicator', $test['buySellIndicator'] ?? '') == 'C' ? 'selected' : '' ?>>C</option>
    </select>
    <br>

    <label for="contractId">Contract ID:</label>
    <input type="text" name="contractId" id="contractId" value="<?= old('contractId', $test['contractId'] ?? '') ?>" required>
    <br>

    <label for="contractDate">Contract Date:</label>
    <input type="date" name="contractDate" id="contractDate" value="<?= old('contractDate', $test['contractDate'] ?? '') ?>" required>
    <br>

    <label for="contractType">Contract Type:</label>
    <select name="contractType" id="contractType" required>
        <option value="" disabled <?= !isset($test['contractType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="SO" <?= old('contractType', $test['contractType'] ?? '') == 'SO' ? 'selected' : '' ?>>SO</option>
        <option value="FW" <?= old('contractType', $test['contractType'] ?? '') == 'FW' ? 'selected' : '' ?>>FW</option>
        <option value="FU" <?= old('contractType', $test['contractType'] ?? '') == 'FU' ? 'selected' : '' ?>>FU</option>
        <option value="OP" <?= old('contractType', $test['contractType'] ?? '') == 'OP' ? 'selected' : '' ?>>OP</option>
        <option value="OP_FW" <?= old('contractType', $test['contractType'] ?? '') == 'OP_FW' ? 'selected' : '' ?>>OP_FW</option>
        <option value="OP_FU" <?= old('contractType', $test['contractType'] ?? '') == 'OP_FU' ? 'selected' : '' ?>>OP_FU</option>
        <option value="OP_SW" <?= old('contractType', $test['contractType'] ?? '') == 'OP_SW' ? 'selected' : '' ?>>OP_SW</option>
        <option value="SP" <?= old('contractType', $test['contractType'] ?? '') == 'SP' ? 'selected' : '' ?>>SP</option>
        <option value="SW" <?= old('contractType', $test['contractType'] ?? '') == 'SW' ? 'selected' : '' ?>>SW</option>
        <option value="OT" <?= old('contractType', $test['contractType'] ?? '') == 'OT' ? 'selected' : '' ?>>OT</option>
    </select>
    <br>

    <label for="energyCommodity">Energy Commodity:</label>
    <select name="energyCommodity" id="contractType" required>
        <option value="" disabled <?= !isset($test['energyCommodity']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="EL" <?= old('energyCommodity', $test['energyCommodity'] ?? '') == 'EL' ? 'selected' : '' ?>>EL</option>
        <option value="NG" <?= old('energyCommodity', $test['energyCommodity'] ?? '') == 'NG' ? 'selected' : '' ?>>NG</option>
    </select>
    <br>

    <label for="priceValue">Price Value:</label>
    <input type="text" name="priceValue" id="priceValue" value="<?= old('priceValue', $test['priceValue'] ?? '') ?>">
    <br>

    <label for="priceCurrency">Price Currency:</label>
    <select name="priceCurrency" id="priceCurrency">
        <option value="" <?= !isset($test['priceCurrency']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="BGN" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'BGN' ? 'selected' : '' ?>>BGN</option>
        <option value="CHF" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'CHF' ? 'selected' : '' ?>>CHF</option>
        <option value="CZK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'CZK' ? 'selected' : '' ?>>CZK</option>
        <option value="DKK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'DKK' ? 'selected' : '' ?>>DKK</option>
        <option value="EUR" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'EUR' ? 'selected' : '' ?>>EUR</option>
        <option value="EUX" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'EUX' ? 'selected' : '' ?>>EUX</option>
        <option value="GBX" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'GBX' ? 'selected' : '' ?>>GBX</option>
        <option value="GBP" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'GBP' ? 'selected' : '' ?>>GBP</option>
        <option value="HRK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'HRK' ? 'selected' : '' ?>>HRK</option>
        <option value="HUF" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'HUF' ? 'selected' : '' ?>>HUF</option>
        <option value="ISK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'ISK' ? 'selected' : '' ?>>ISK</option>
        <option value="NOK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'NOK' ? 'selected' : '' ?>>NOK</option>
        <option value="PCT" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'PCT' ? 'selected' : '' ?>>PCT</option>
        <option value="PLN" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'PLN' ? 'selected' : '' ?>>PLN</option>
        <option value="RON" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'RON' ? 'selected' : '' ?>>RON</option>
        <option value="SEK" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'SEK' ? 'selected' : '' ?>>SEK</option>
        <option value="USD" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'USD' ? 'selected' : '' ?>>USD</option>
        <option value="OTH" <?= old('priceCurrency', $test['priceCurrency'] ?? '') == 'OTH' ? 'selected' : '' ?>>OTH</option>
    </select>
    <br>

    <label for="priceFormula">Price Formula:</label>
    <textarea name="priceFormula" id="priceFormula"><?= old('priceFormula', $test['priceFormula'] ?? '') ?></textarea>
    <br>

    <label for="estimatedNotionalAmountValue">Estimated Notional Amount Value:</label>
    <input type="text" name="estimatedNotionalAmountValue" id="estimatedNotionalAmountValue" value="<?= old('estimatedNotionalAmountValue', $test['estimatedNotionalAmountValue'] ?? '') ?>">
    <br>

    <label for="estimatedNotionalAmountCurrency">Estimated Notional Amount Currency:</label>
    <select name="estimatedNotionalAmountCurrency" id="estimatedNotionalAmountCurrency">
        <option value="" <?= !isset($test['estimatedNotionalAmountCurrency']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="BGN" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'BGN' ? 'selected' : '' ?>>BGN</option>
        <option value="CHF" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'CHF' ? 'selected' : '' ?>>CHF</option>
        <option value="CZK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'CZK' ? 'selected' : '' ?>>CZK</option>
        <option value="DKK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'DKK' ? 'selected' : '' ?>>DKK</option>
        <option value="EUR" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'EUR' ? 'selected' : '' ?>>EUR</option>
        <option value="EUX" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'EUX' ? 'selected' : '' ?>>EUX</option>
        <option value="GBX" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'GBX' ? 'selected' : '' ?>>GBX</option>
        <option value="GBP" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'GBP' ? 'selected' : '' ?>>GBP</option>
        <option value="HRK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'HRK' ? 'selected' : '' ?>>HRK</option>
        <option value="HUF" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'HUF' ? 'selected' : '' ?>>HUF</option>
        <option value="ISK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'ISK' ? 'selected' : '' ?>>ISK</option>
        <option value="NOK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'NOK' ? 'selected' : '' ?>>NOK</option>
        <option value="PCT" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'PCT' ? 'selected' : '' ?>>PCT</option>
        <option value="PLN" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'PLN' ? 'selected' : '' ?>>PLN</option>
        <option value="RON" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'RON' ? 'selected' : '' ?>>RON</option>
        <option value="SEK" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'SEK' ? 'selected' : '' ?>>SEK</option>
        <option value="USD" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'USD' ? 'selected' : '' ?>>USD</option>
        <option value="OTH" <?= old('estimatedNotionalAmountCurrency', $test['estimatedNotionalAmountCurrency'] ?? '') == 'OTH' ? 'selected' : '' ?>>OTH</option>
    </select>
    <br>

    <label for="totalNotionalContractQuantityValue">Total Notional Contract Quantity Value:</label>
    <input type="text" name="totalNotionalContractQuantityValue" id="totalNotionalContractQuantityValue" value="<?= old('totalNotionalContractQuantityValue', $test['totalNotionalContractQuantityValue'] ?? '') ?>">
    <br>

    <label for="totalNotionalContractQuantityUnit">Total Notional Contract Quantity Unit:</label>
    <select name="totalNotionalContractQuantityUnit" id="totalNotionalContractQuantityUnit">
        <option value="" <?= !isset($test['totalNotionalContractQuantityUnit']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="KWh" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'KWh' ? 'selected' : '' ?>>KWh</option>
        <option value="MWh" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'MWh' ? 'selected' : '' ?>>MWh</option>
        <option value="GWh" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'GWh' ? 'selected' : '' ?>>GWh</option>
        <option value="Therm" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'Therm' ? 'selected' : '' ?>>Therm</option>
        <option value="KTherm" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'KTherm' ? 'selected' : '' ?>>KTherm</option>
        <option value="MTherm" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'MTherm' ? 'selected' : '' ?>>MTherm</option>
        <option value="cm" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'cm' ? 'selected' : '' ?>>cm</option>
        <option value="mcm" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'mcm' ? 'selected' : '' ?>>mcm</option>
        <option value="Btu" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'Btu' ? 'selected' : '' ?>>Btu</option>
        <option value="MMBtu" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'MMBtu' ? 'selected' : '' ?>>MMBtu</option>
        <option value="MJ" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'MJ' ? 'selected' : '' ?>>MJ</option>
        <option value="MMJ" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'MMJ' ? 'selected' : '' ?>>MMJ</option>
        <option value="100MJ" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == '100MJ' ? 'selected' : '' ?>>100MJ</option>
        <option value="GJ" <?= old('totalNotionalContractQuantityUnit', $test['totalNotionalContractQuantityUnit'] ?? '') == 'GJ' ? 'selected' : '' ?>>GJ</option>
    </select>
    <br>

    <label for="volumeOptionality">Volume Optionality:</label>
    <select name="volumeOptionality" id="volumeOptionality">
        <option value="" <?= !isset($test['volumeOptionality']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="V" <?= old('volumeOptionality', $test['volumeOptionality'] ?? '') == 'V' ? 'selected' : '' ?>>V</option>
        <option value="F" <?= old('volumeOptionality', $test['volumeOptionality'] ?? '') == 'F' ? 'selected' : '' ?>>F</option>
        <option value="M" <?= old('volumeOptionality', $test['volumeOptionality'] ?? '') == 'M' ? 'selected' : '' ?>>M</option>
        <option value="C" <?= old('volumeOptionality', $test['volumeOptionality'] ?? '') == 'C' ? 'selected' : '' ?>>C</option>
        <option value="O" <?= old('volumeOptionality', $test['volumeOptionality'] ?? '') == 'O' ? 'selected' : '' ?>>O</option>
    </select>
    <br>

    <label for="typeOfIndexPrice">Type Of Index Price:</label>
    <input type="text" name="typeOfIndexPrice" id="typeOfIndexPrice" value="<?= old('typeOfIndexPrice', $test['typeOfIndexPrice'] ?? '') ?>">
    <br>

    <label for="typeOfIndexPrice">Type Of Index Price:</label>
    <select name="typeOfIndexPrice" id="typeOfIndexPrice">
        <option value="" <?= !isset($test['typeOfIndexPrice']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="F" <?= old('typeOfIndexPrice', $test['typeOfIndexPrice'] ?? '') == 'F' ? 'selected' : '' ?>>F</option>
        <option value="I" <?= old('typeOfIndexPrice', $test['typeOfIndexPrice'] ?? '') == 'I' ? 'selected' : '' ?>>I</option>
        <option value="C" <?= old('typeOfIndexPrice', $test['typeOfIndexPrice'] ?? '') == 'C' ? 'selected' : '' ?>>C</option>
        <option value="O" <?= old('typeOfIndexPrice', $test['typeOfIndexPrice'] ?? '') == 'O' ? 'selected' : '' ?>>O</option>
    </select>
    <br>

    <label for="fixingIndex">Fixing Index:</label>
    <input type="text" name="fixingIndex" id="fixingIndex" value="<?= old('fixingIndex', $test['fixingIndex'] ?? '') ?>">
    <br>

    <label for="fixingIndexType">Fixing Index Type:</label>
    <select name="fixingIndexType" id="fixingIndexType">
        <option value="" <?= !isset($test['fixingIndexType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="SO" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'SO' ? 'selected' : '' ?>>SO</option>
        <option value="FW" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'FW' ? 'selected' : '' ?>>FW</option>
        <option value="FU" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'FU' ? 'selected' : '' ?>>FU</option>
        <option value="OP" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'OP' ? 'selected' : '' ?>>OP</option>
        <option value="OP_FW" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'OP_FW' ? 'selected' : '' ?>>OP_FW</option>
        <option value="OP_FU" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'OP_FU' ? 'selected' : '' ?>>OP_FU</option>
        <option value="OP_SW" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'OP_SW' ? 'selected' : '' ?>>OP_SW</option>
        <option value="SP" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'SP' ? 'selected' : '' ?>>SP</option>
        <option value="SW" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'SW' ? 'selected' : '' ?>>SW</option>
        <option value="OT" <?= old('fixingIndexType', $test['fixingIndexType'] ?? '') == 'OT' ? 'selected' : '' ?>>OT</option>
    </select>
    <br>

    <label for="fixingIndexSource">Fixing Index Source:</label>
    <input type="text" name="fixingIndexSource" id="fixingIndexSource" value="<?= old('fixingIndexSource', $test['fixingIndexSource'] ?? '') ?>">
    <br>

    <label for="firstFixingDate">First Fixing Date:</label>
    <input type="date" name="firstFixingDate" id="firstFixingDate" value="<?= old('firstFixingDate', $test['firstFixingDate'] ?? '') ?>">
    <br>

    <label for="lastFixingDate">Last Fixing Date:</label>
    <input type="date" name="lastFixingDate" id="lastFixingDate" value="<?= old('lastFixingDate', $test['lastFixingDate'] ?? '') ?>">
    <br>

    <label for="fixingFrequency">Fixing Frequency:</label>
    <select name="fixingFrequency" id="fixingFrequency">
        <option value="" <?= !isset($test['fixingFrequency']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="X" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'X' ? 'selected' : '' ?>>X</option>
        <option value="H" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'H' ? 'selected' : '' ?>>H</option>
        <option value="D" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'D' ? 'selected' : '' ?>>D</option>
        <option value="W" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'W' ? 'selected' : '' ?>>W</option>
        <option value="M" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'M' ? 'selected' : '' ?>>M</option>
        <option value="Q" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'Q' ? 'selected' : '' ?>>Q</option>
        <option value="S" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'S' ? 'selected' : '' ?>>S</option>
        <option value="A" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'A' ? 'selected' : '' ?>>A</option>
        <option value="O" <?= old('fixingFrequency', $test['fixingFrequency'] ?? '') == 'O' ? 'selected' : '' ?>>O</option>
    </select>
    <br>

    <label for="settlementMethod">Settlement Method:</label>
    <select name="settlementMethod" id="settlementMethod" required>
        <option value="" disabled <?= !isset($test['settlementMethod']) && !old('settlementMethod') ? 'selected' : '' ?>>Выберите тип</option>
        <option value="P" <?= old('settlementMethod', $test['settlementMethod'] ?? 'P') == 'P' ? 'selected' : '' ?>>P</option>
        <option value="C" <?= old('settlementMethod', $test['settlementMethod'] ?? 'P') == 'C' ? 'selected' : '' ?>>C</option>
        <option value="O" <?= old('settlementMethod', $test['settlementMethod'] ?? 'P') == 'O' ? 'selected' : '' ?>>O</option>
    </select>
    <br>

    <label for="deliveryPointOrZone">Delivery Point Or Zone:</label>
    <input type="text" name="deliveryPointOrZone" id="deliveryPointOrZone" value="<?= old('deliveryPointOrZone', $test['deliveryPointOrZone'] ?? '') ?>" required>
    <br>

    <label for="deliveryStartDate">Delivery Start Date:</label>
    <input type="date" name="deliveryStartDate" id="deliveryStartDate" value="<?= old('deliveryStartDate', $test['deliveryStartDate'] ?? '') ?>" required>
    <br>

    <label for="deliveryEndDate">Delivery End Date:</label>
    <input type="date" name="deliveryEndDate" id="deliveryEndDate" value="<?= old('deliveryEndDate', $test['deliveryEndDate'] ?? '') ?>" required>
    <br>

    <label for="loadType">Load Type:</label>
    <select name="loadType" id="loadType" required>
        <option value="" disabled <?= !isset($test['loadType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="BL" <?= old('loadType', $test['loadType'] ?? '') == 'BL' ? 'selected' : '' ?>>BL</option>
        <option value="PL" <?= old('loadType', $test['loadType'] ?? '') == 'PL' ? 'selected' : '' ?>>PL</option>
        <option value="OP" <?= old('loadType', $test['loadType'] ?? '') == 'OP' ? 'selected' : '' ?>>OP</option>
        <option value="BH" <?= old('loadType', $test['loadType'] ?? '') == 'BH' ? 'selected' : '' ?>>BH</option>
        <option value="SH" <?= old('loadType', $test['loadType'] ?? '') == 'SH' ? 'selected' : '' ?>>SH</option>
        <option value="GD" <?= old('loadType', $test['loadType'] ?? '') == 'GD' ? 'selected' : '' ?>>GD</option>
        <option value="OT" <?= old('loadType', $test['loadType'] ?? '') == 'OT' ? 'selected' : '' ?>>OT</option>
    </select>
    <br>

    <label for="actionType">Action Type:</label>
    <select name="actionType" id="actionType" required>
        <option value="" disabled <?= !isset($test['actionType']) ? 'selected' : '' ?>>Выберите тип</option>
        <option value="N" <?= old('actionType', $test['actionType'] ?? '') == 'N' ? 'selected' : '' ?>>N</option>
        <option value="M" <?= old('actionType', $test['actionType'] ?? '') == 'M' ? 'selected' : '' ?>>M</option>
        <option value="E" <?= old('actionType', $test['actionType'] ?? '') == 'E' ? 'selected' : '' ?>>E</option>
        <option value="C" <?= old('actionType', $test['actionType'] ?? '') == 'C' ? 'selected' : '' ?>>C</option>
    </select>
    <br>

    <button type="submit"><?= isset($test) ? 'Обновить' : 'Сохранить' ?></button>
</form>

</body>
</html>
