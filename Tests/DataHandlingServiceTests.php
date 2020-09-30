<?php
require 'vendor/autoload.php';
require 'Services/DataHandlingService.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DataHandlingServiceTests extends TestCase
{
    /** @test */
    public function getCouncillorsByPageNumberTest()
    {
        // Arrange
        $data = '[{
              "id":4154,
              "updated":"2020-05-26T10:59:56Z",
              "active":true,
              "code":"PER_3055_",
              "firstName":"Jean-Luc",
              "lastName":"Addor",
              "number":3055,
              "officialDenomination":"Addor",
              "salutationLetter":null,
              "salutationTitle":null
           },
           {
              "id":3867,
              "updated":"2019-11-13T15:22:53Z",
              "active":true,
              "code":"PER_2670_",
              "firstName":"Andreas",
              "lastName":"Aebi",
              "number":2670,
              "officialDenomination":"Aebi Andreas",
              "salutationLetter":null,
              "salutationTitle":null
           },
           {
              "id":4049,
              "updated":"2020-03-04T08:32:37Z",
              "active":true,
              "code":"PER_2760_",
              "firstName":"Matthias",
              "lastName":"Aebischer",
              "number":2760,
              "officialDenomination":"Aebischer Matthias",
              "salutationLetter":null,
              "salutationTitle":null
           }]';

        $mock = new MockHandler([
            new Response(200, [], $data)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedCouncillors = $service->getCouncillorsByPageNumber(5);
        $first = $fetchedCouncillors[0];

        // Assert
        $this->assertSame(3, count($fetchedCouncillors));
        $this->assertInstanceOf('CouncillorDTO', $first);
    }

    /** @test */
    public function getCouncillorsResponseErrorTest()
    {
        // Arrange
        $mock = new MockHandler([
            new Response(500, [], '')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedCouncillors = $service->getCouncillorsByPageNumber(5);

        // Assert
        $this->assertSame(0, count($fetchedCouncillors));
    }

    /** @test */
    public function getCouncillorsRequestErrorTest()
    {
        // Arrange
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedCouncillors = $service->getCouncillorsByPageNumber(555);

        // Assert
        $this->assertSame(0, count($fetchedCouncillors));
        $this->getExpectedExceptionCode(500);
    }

    /** @test */
    public function getFactionsTest()
    {
        $data = '[{
              "id":5,
              "updated":"2010-12-26T13:07:50Z",
              "abbreviation":"U",
              "code":"FRA_5_",
              "name":"Gruppo degli ind. ed ev.",
              "shortName":"Gruppo U"
           },
           {
              "id":6,
              "updated":"2010-12-26T13:07:50Z",
              "abbreviation":"G",
              "code":"FRA_6_",
              "name":"Gruppo dei Verdi",
              "shortName":"Gruppo G"
           }]';

        $mock = new MockHandler([
            new Response(200, [], $data)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedFactions = $service->getFactions();
        $first = $fetchedFactions[0];

        // Assert
        $this->assertSame(2, count($fetchedFactions));
        $this->assertInstanceOf('FactionDTO', $first);
    }

    /** @test */
    public function getFactionsResponseErrorTest()
    {
        // Arrange
        $mock = new MockHandler([
            new Response(500, [], '')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedFactions = $service->getFactions();

        // Assert
        $this->assertSame(0, count($fetchedFactions));
    }

    /** @test */
    public function getFactionsRequestErrorTest()
    {
        // Arrange
        $mock = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = new DataHandlingService($client);

        // Act
        $fetchedFactions = $service->getFactions();

        // Assert
        $this->assertSame(0, count($fetchedFactions));
        $this->getExpectedExceptionCode(500);
    }

    /**
     * @test
     * @dataProvider pageNumberProvider
     */
    public function parsePageNumberTest($pageNumber, $expectedValue)
    {
        //Arrange
        $client = new Client();
        $service = new DataHandlingService($client);

        //Act
        $result = $service->parsePageNumber($pageNumber);

        //Assert
        $this->assertSame($expectedValue, $result);
    }

    public function pageNumberProvider()
    {
        return [
            ['asbd', 1],
            [-1, 1],
            [1.32, 1],
            [125, 125]
        ];
    }
}
