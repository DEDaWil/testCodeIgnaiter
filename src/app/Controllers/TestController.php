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
        $test = $this->testModel->find($id);

        if ($this->testModel->delete($id)) {
            $filePath = 'test/' . $test['name'] . '.xml';
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            return redirect()->to('/test')->with('success', 'Запись успешно удалена');
        }

        return redirect()->to('/test')->with('error', 'Ошибка при удалении записи');
    }

    public function downloadXML($id)
    {
        $test = $this->testModel->find($id);
        $filePath = 'test/' . $test['name'] . '.xml';

        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404)->setBody("File not found.");
        }

        return $this->response->download($filePath, null)->setFileName($test['name'] . '.xml');
    }

    /**
     * @throws DOMException
     * @throws Exception
     */
    public function createXML($test): void
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->standalone = true;
        $dom->formatOutput = true;

        $REMITTable2 = $dom->createElement('REMITTable2');
        $REMITTable2->setAttribute('xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable2_V1.xsd');
        $dom->appendChild($REMITTable2);

        $this->addGroupWithElements($dom, $REMITTable2, 'reportingEntityID', [
            $test['reportingEntityIDType'] => $test['reportingEntityID']
        ]);

        $tradeList = $dom->createElement('TradeList');
        $nonStandardContractReport = $dom->createElement('nonStandardContractReport');

        $nonStandardContractReport->appendChild($dom->createElement('RecordSeqNumber', $test['recordSeqNumber']));
        $this->addGroupWithElements($dom, $nonStandardContractReport, 'idOfMarketParticipant', [
            $test['idOfMarketParticipantType'] => $test['idOfMarketParticipant']
        ]);
        $this->addGroupWithElements($dom, $nonStandardContractReport, 'otherMarketParticipant', [
            $test['otherMarketParticipantType'] => $test['otherMarketParticipant']
        ]);
        $nonStandardContractReport->appendChild($dom->createElement('tradingCapacity', $test['tradingCapacity']));
        $nonStandardContractReport->appendChild($dom->createElement('buySellIndicator', $test['buySellIndicator']));
        $nonStandardContractReport->appendChild($dom->createElement('contractId', $test['contractId']));
        $nonStandardContractReport->appendChild($dom->createElement('contractDate', $test['contractDate']));
        $nonStandardContractReport->appendChild($dom->createElement('contractType', $test['contractType']));
        $nonStandardContractReport->appendChild($dom->createElement('energyCommodity', $test['energyCommodity']));
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
        if ($test['volumeOptionality']) {
            $nonStandardContractReport->appendChild($dom->createElement('volumeOptionality', $test['volumeOptionality']));
        }
        if ($test['typeOfIndexPrice']) {
            $nonStandardContractReport->appendChild($dom->createElement('typeOfIndexPrice', $test['typeOfIndexPrice']));
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
        $nonStandardContractReport->appendChild($dom->createElement('settlementMethod', $test['settlementMethod']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryPointOrZone', $test['deliveryPointOrZone']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryStartDate', $test['deliveryStartDate']));
        $nonStandardContractReport->appendChild($dom->createElement('deliveryEndDate', $test['deliveryEndDate']));
        if ($test['loadType']) {
            $nonStandardContractReport->appendChild($dom->createElement('loadType', $test['loadType']));
        }
        $nonStandardContractReport->appendChild($dom->createElement('actionType', $test['actionType']));

        $tradeList->appendChild($nonStandardContractReport);;
        $REMITTable2->appendChild($tradeList);

        $dom->save('test/' . $test['name'] . '.xml');

        $dom->load('test/' . $test['name'] . '.xml');
        libxml_use_internal_errors(true);
//        try {
            if (!$dom->schemaValidate(APPPATH . 'Validation/Schemas/REMITTable2_V1-1.xsd')) {
                // Если валидация не прошла, выбрасываем исключение с деталями
                $errors = libxml_get_errors(); // Получаем список ошибок
                $errorMessages = '';
//dd($errors);
                foreach ($errors as $error) {
                    $errorMessages .= $this->formatLibXMLError($error) . "\n"; // Форматируем ошибки
                }

                libxml_clear_errors(); // Очищаем внутренний буфер ошибок
                throw new Exception("XML не соответствует XSD схеме:\n" . $errorMessages);
            }

//            echo "XML валидный!";
//        } catch (Exception $e) {
//            echo "Ошибка: " . $e->getMessage(); // Выводим сообщение об ошибке
//        }




//         Валидация по XSD
//        if (!$dom->schemaValidate(APPPATH . 'Validation/Schemas/REMITTable2_V1-1.xsd')) {
//            throw new Exception('XML не соответствует XSD схеме.');
//        }
    }

    private function formatLibXMLError($error)
    {
        $return = "Ошибка [{$error->code}]: ";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "Предупреждение ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "Ошибка ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "Фатальная ошибка ";
                break;
        }
        $return .= trim($error->message);

        if ($error->file) {
            $return .= " в файле {$error->file}";
        }

        $return .= " на строке {$error->line}, колонка {$error->column}.";
        return $return;
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