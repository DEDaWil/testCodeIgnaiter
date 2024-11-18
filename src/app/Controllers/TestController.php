<?php

namespace App\Controllers;

use App\Models\TestModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use DOMDocument;
use DOMException;
use Exception;
use ReflectionException;

class TestController extends Controller
{
    protected TestModel $testModel;

    public function __construct()
    {
        $this->testModel = new TestModel();
    }

    public function index(): string
    {
        $data['tests'] = $this->testModel->findAll();
        return view('test/index', $data);
    }

    public function create(): string
    {
        return view('test/form');
    }

    /**
     * @throws DOMException
     * @throws ReflectionException
     */
    public function store()
    {
        $data = $this->request->getPost();

        $this->createXML($data);

        if ($this->testModel->insert($data)) {
            return redirect()->to('/test')->with('success', 'Запись успешно добавлена');
        }

        // В случае ошибки валидации возвращаемся с ошибками
        return redirect()->back()->withInput()->with('errors', $this->testModel->errors());
    }

    public function edit($id): string
    {
        $data['test'] = $this->testModel->find($id);

        if (!$data['test']) {
            throw new PageNotFoundException("Запись с ID $id не найдена.");
        }

        return view('test/form', $data);
    }

    /**
     * @throws DOMException
     * @throws ReflectionException
     */
    public function update($id)
    {
        $data = $this->request->getPost();

        $this->createXML($data);

        if ($this->testModel->update($id, $data)) {
            return redirect()->to('/test')->with('success', 'Запись успешно обновлена');
        }

        return redirect()->back()->withInput()->with('errors', $this->testModel->errors());
    }

    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->testModel->delete($id)) {
            return redirect()->to('/test')->with('success', 'Запись успешно удалена');
        }

        return redirect()->to('/test')->with('error', 'Ошибка при удалении записи');
    }

    public function downloadXML($id)
    {
        $test = $this->testModel->find($id);
        $filePath = 'test/' . $test['name'] . '.xml';
//        dd($filePath);
        // Проверьте, существует ли файл
        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404)->setBody("File not found.");
        }

        return $this->response->download($filePath, null)->setFileName($test['name'] . '.xml');
    }

    /**
     * @throws DOMException
     */
    public function createXML($test): void
    {
//        $test = $this->testModel->find($id);

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->standalone = true;
        $dom->formatOutput = true;

        // Корневой элемент <REMITTable2> с пространством имен
        $REMITTable2 = $dom->createElement('REMITTable2');
        $REMITTable2->setAttribute('xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable2_V1.xsd');
        $dom->appendChild($REMITTable2);

        $this->addGroupWithElements($dom, $REMITTable2, 'reportingEntityID', [$test['reportingEntityIDType'] => $test['reportingEntityID']]);

        $tradeList = $dom->createElement('TradeList');
        $nonStandardContractReport = $dom->createElement('nonStandardContractReport');

        $nonStandardContractReport->appendChild($dom->createElement('RecordSeqNumber', $test['recordSeqNumber']));
        $nonStandardContractReport->appendChild($dom->createElement('tradingCapacity', $test['tradingCapacity']));
        $nonStandardContractReport->appendChild($dom->createElement('buySellIndicator', $test['buySellIndicator']));
        $nonStandardContractReport->appendChild($dom->createElement('contractId', $test['contractId']));
        $nonStandardContractReport->appendChild($dom->createElement('contractDate', $test['contractDate']));
        $nonStandardContractReport->appendChild($dom->createElement('contractType', $test['contractType']));
        $nonStandardContractReport->appendChild($dom->createElement('energyCommodity', $test['energyCommodity']));
        $nonStandardContractReport->appendChild($dom->createElement('settlementMethod', $test['settlementMethod']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryPointOrZone', $test['deliveryPointOrZone']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryStartDate', $test['deliveryStartDate']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryEndDate', $test['deliveryEndDate']));
        $nonStandardContractReport->appendChild($dom->createElement('actionType', $test['actionType']));

        if ($test['loadType']) {
            $nonStandardContractReport->appendChild($dom->createElement('loadType', $test['loadType']));
        }
        if ($test['volumeOptionality']) {
            $nonStandardContractReport->appendChild($dom->createElement('volumeOptionality', $test['volumeOptionality']));
        }
        if ($test['typeOfIndexPrice']) {
            $nonStandardContractReport->appendChild($dom->createElement('typeOfIndexPrice', $test['typeOfIndexPrice']));
        }

        $this->addGroupWithElements($dom, $nonStandardContractReport, 'idOfMarketParticipant', [
            $test['idOfMarketParticipantType'] => $test['idOfMarketParticipant']
        ]);
        $this->addGroupWithElements($dom, $nonStandardContractReport, 'otherMarketParticipant', [
            $test['otherMarketParticipantType'] => $test['otherMarketParticipant']
        ]);
        if ($test['estimatedNotionalAmountValue'] AND $test['estimatedNotionalAmountCurrency']) {
            $this->addGroupWithElements($dom, $nonStandardContractReport, 'estimatedNotionalAmount', [
                'value' => $test['estimatedNotionalAmountValue'],
                'currency' => $test['estimatedNotionalAmountCurrency'],
            ]);
        }
        if ($test['totalNotionalContractQuantityValue'] AND $test['totalNotionalContractQuantityUnit']) {
            $this->addGroupWithElements($dom, $nonStandardContractReport, 'totalNotionalContractQuantity', [
                'value' => $test['totalNotionalContractQuantityValue'],
                'unit' => $test['totalNotionalContractQuantityUnit'],
            ]);
        }
        if ($test['fixingIndex'] AND ($test['fixingIndexType'] OR $test['fixingIndexSource'] OR $test['firstFixingDate'] OR $test['lastFixingDate'] OR $test['fixingFrequency'])) {
            $this->addGroupWithElements($dom, $nonStandardContractReport, 'fixingIndexDetails', [
                'fixingIndex' => $test['fixingIndex'],
                'fixingIndexType' => $test['fixingIndexType'],
                'fixingIndexSource' => $test['fixingIndexSource'],
                'firstFixingDate' => $test['firstFixingDate'],
                'lastFixingDate' => $test['lastFixingDate'],
                'fixingFrequency' => $test['fixingFrequency'],
            ]);
        }

        if ($test['priceFormula']) {
            $this->addGroupWithElements($dom, $nonStandardContractReport, 'priceOrPriceFormula', [
                'priceFormula' => $test['priceFormula']
            ]);
        } elseif ($test['priceValue'] AND $test['priceCurrency']) {
            $priceOrPriceFormula = $dom->createElement('priceOrPriceFormula');
            $this->addGroupWithElements($dom, $priceOrPriceFormula, 'price', [
                'value' => $test['priceValue'],
                'currency' => $test['priceCurrency'],
            ]);
            $nonStandardContractReport->appendChild($priceOrPriceFormula);
        }

        $tradeList->appendChild($nonStandardContractReport);;
        $REMITTable2->appendChild($tradeList);

        $dom->save('test/' . $test['name'] . '.xml');

//         Валидация по XSD
//        libxml_use_internal_errors(true);
//        if (!$dom->schemaValidate(APPPATH . 'Validation/Schemas/REMITTable2_V1-1.xsd')) {
//            throw new Exception('XML не соответствует XSD схеме.');
//        }
    }

    private function addGroupWithElements($dom, $parent, $groupName, $elements): void
    {
        $group = $dom->createElement($groupName);
        foreach ($elements as $tagName => $value) {
            if (!empty($value)) {
                $element = $dom->createElement($tagName, htmlspecialchars($value));
                $group->appendChild($element);
            }
        }
        $parent->appendChild($group);
    }
}