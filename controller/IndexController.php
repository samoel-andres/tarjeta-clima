<?php

class IndexController
{
    private $view;
    private $city;
    private $key;
    private $endpoint;
    private $endpointb;
    private $uri;
    private $urib;
    private $formatter;

    public function __construct()
    {
        $this->endpointb = $_ENV['ENDPOINT_B'];
        $this->endpoint = $_ENV['ENDPOINT'];
        $this->key = $_ENV['KEY'];
        $this->city = 'London';

        $this->uri = "{$this->endpoint}?q={$this->city}&units=metric&appid={$this->key}";
        $this->urib = "{$this->endpointb}?q={$this->city}&units=metric&appid={$this->key}";

        $this->formatter = new IntlDateFormatter(
            'en_EN',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'UTC'
        );

        $this->view = new View();
    }

    public function index()
    {
        try {
            $response = $this->fetchWeatherData($this->uri);
            $responseb = $this->fetchWeatherData($this->urib);

            if (!$response || isset($response['cod']) && $response['cod'] !== 200) {
                throw new Exception('Error al obtener datos de la API principal');
            }

            $data = [
                [
                    "weather" => $response['weather'][0]['main'],
                    "temperature" => substr($response['main']['temp'], 0, 1),
                    "day" => date('l', $response['dt']),
                    "date" => $this->formatter->format($response['dt']),
                    "location" => $response['name'],
                    "description" => ucfirst($response['weather'][0]['description']),
                    "visibility" => $response['visibility'] / 1000,
                    "humidity" => $response['main']['humidity'],
                    "wind" => substr($response['wind']['speed'], 0, 1),
                    "icon" => "https://openweathermap.org/img/wn/" . $response['weather'][0]['icon'] . ".png"
                ],
                $this->formatForecast($responseb, 6),
                $this->formatForecast($responseb, 14),
                $this->formatForecast($responseb, 22),
                $this->formatForecast($responseb, 30)
            ];

            $this->view->view('weather.php', $data);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    private function fetchWeatherData($uri)
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            die('Error: No se pudo conectar a la API, cURL error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            die("Error: La API ha devolvió un código {$httpCode}");
        }

        return json_decode($response, true);
    }

    private function formatForecast($data, $index)
    {
        if (!isset($data['list'][$index])) {
            throw new Exception("Error: indice de pronóstico {$index} no encontrado");
        }

        return [
            "day" => date('D', $data['list'][$index]['dt']),
            "temperature" => substr($data['list'][$index]['main']['temp'], 0, 1),
            "icon" => "https://openweathermap.org/img/wn/" . $data['list'][$index]['weather'][0]['icon'] . ".png"
        ];
    }
}
