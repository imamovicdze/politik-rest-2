<?php

require 'vendor/autoload.php';
require 'DTO/FactionDTO.php';
require 'DTO/CouncillorDTO.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DataHandlingService
{
    public $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Return councillors with pageNumber param
     *
     * @param $pageNumber
     * @return mixed
     * @throws GuzzleException
     */
    public function getCouncillorsByPageNumber($pageNumber)
    {
        $data = [];

        try {
            $res = $this->client->request('GET', $this->getCouncillorPageNumberUrl($pageNumber), [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            if ($res->getStatusCode() == 200) {
                $councillors = json_decode($res->getBody());

                foreach ($councillors as $councillor) {
                    $data[] = new CouncillorDTO($councillor);
                }
                return $data;
            } else {
                return $data;
            }
        } catch (Exception $e) {
            return $data;
        }
    }

    /**
     * Return factions
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function getFactions()
    {
        $data = [];

        try {
            $res = $this->client->request('GET', $this->getFactionsUrl(), [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            if ($res->getStatusCode() == 200) {
                $factions = json_decode($res->getBody());

                foreach ($factions as $faction) {
                    $data[] = new FactionDTO($faction);
                }
                return $data;
            } else {
                return $data;
            }
        } catch (Exception $e) {
            return $data;
        }
    }

    /**
     * Render content
     *
     * @param $url
     * @param $pageNumber
     * @throws GuzzleException
     */
    public function renderContent($url, $pageNumber)
    {
        $uri = isset($url) ? $url : null;

        if ((strpos($uri, 'factions') !== false)) {
            $factionsData = $this->getFactions();

            $this->includeFileWithVariables('Pages/factions.php', [
                'data' => $factionsData,
                'title' => 'Factions'
            ]);
        } elseif ((strpos($uri, 'councillors') !== false)) {
            $pageNumber = $this->parsePageNumber($pageNumber);
            $councillorsData = $this->getCouncillorsByPageNumber($pageNumber);

            $this->includeFileWithVariables('Pages/councillors.php', [
                'data' => $councillorsData,
                'title' => 'Councillors'
            ]);
        } else {
            $this->includeFileWithVariables('Pages/default.php', [
                'title' => 'Politik Rest 2nd - index page'
            ]);
        }
    }

    /**
     * Return different councillors with pageNumber url
     *
     * @param $pageNumber
     * @return string
     */
    private function getCouncillorPageNumberUrl($pageNumber)
    {
        return 'http://ws-old.parlament.ch/councillors?entryDateFilter=2018/12/31&format=json&pageNumber=' . $pageNumber;
    }

    /**
     * Return factions url
     *
     * @return string
     */
    private function getFactionsUrl()
    {
        return 'http://ws-old.parlament.ch/factions?format=json';
    }

    /**
     * Function render files with variables
     *
     * @param $fileName
     * @param $variables
     */
    private function includeFileWithVariables($fileName, $variables)
    {
        extract($variables);
        include($fileName);
    }

    /**
     * Parse pageNumber
     *
     * @param $pageNumberStr
     * @return int
     */
    public function parsePageNumber($pageNumberStr)
    {
        $pageNumber = intval($pageNumberStr);

        return $pageNumber <= 0 ? 1 : $pageNumber;
    }
}
