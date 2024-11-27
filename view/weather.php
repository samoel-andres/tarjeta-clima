<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Weather app displaying current weather, visibility, humidity, and forecast for multiple days">
    <meta name="keywords" content="weather, forecast, temperature, humidity, wind">
    <link href="public/css/styles.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Simple weather</title>
</head>

<body>
    <?php
    require_once 'utils/Helper.php';
    $helper = new Helper($variables);
    ?>
    <div class="container">
        <div class="weather-side">
            <div class="weather-gradient"></div>
            <div class="date-container">
                <h2 class="date-dayname"><?php echo ($helper->getValue(0, 'day')) ?></h2>
                <span class="date-day"><?php echo ($helper->getValue(0, 'date')) ?></span>
                <br>
                <div class="location">
                    <i class="location-icon" data-feather="map-pin"></i>
                    <span><?php echo ($helper->getValue(0, 'location')) ?></span>
                </div>
            </div>
            <div class="weather-container">
                <img src="<?php echo ($helper->getValue(0, 'icon')) ?>" alt="Icon Wather">
                <h1 class="weather-temp"><?php echo ($helper->getValue(0, 'temperature')) ?>°C</h1>
                <h3 class="weather-desc"><?php echo ($helper->getValue(0, 'description')) ?></h3>
            </div>
        </div>
        <div class="info-side">
            <div class="today-info-container">
                <div class="today-info">
                    <div class="precipitation">
                        <span class="title">VISIBILITY</span>
                        <span class="value"><?php echo ($helper->getValue(0, 'visibility')) ?> km</span>
                        <div class="clear"></div>
                    </div>
                    <div class="humidity">
                        <span class="title">HUMIDITY</span>
                        <span class="value"><?php echo ($helper->getValue(0, 'humidity')) ?> %</span>
                        <div class="clear"></div>
                    </div>
                    <div class="wind">
                        <span class="title">WIND</span>
                        <span class="value"><?php echo ($helper->getValue(0, 'wind')) ?> km/h</span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="week-container">
                <ul class="week-list">
                    <li class="active">
                        <img src="<?php echo ($helper->getValue(1, 'icon')) ?>" alt="Icon Wather">
                        <span class="day-name"><?php echo ($helper->getValue(1, 'day')) ?></span>
                        <span class="day-temp"><?php echo ($helper->getValue(1, 'temperature')) ?>°C</span>
                    </li>
                    <li>
                        <img src="<?php echo ($helper->getValue(2, 'icon')) ?>" alt="Icon Wather">
                        <span class="day-name"><?php echo ($helper->getValue(2, 'day')) ?></span>
                        <span class="day-temp"><?php echo ($helper->getValue(2, 'temperature')) ?>°C</span>
                    </li>
                    <li>
                        <img src="<?php echo ($helper->getValue(3, 'icon')) ?>" alt="Icon Wather">
                        <span class="day-name"><?php echo ($helper->getValue(3, 'day')) ?></span>
                        <span class="day-temp"><?php echo ($helper->getValue(3, 'temperature')) ?>°C</span>
                    </li>
                    <li>
                        <img src="<?php echo ($helper->getValue(4, 'icon')) ?>" alt="Icon Wather">
                        <span class="day-name"><?php echo ($helper->getValue(4, 'day')) ?></span>
                        <span class="day-temp"><?php echo ($helper->getValue(4, 'temperature')) ?>°C</span>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="location-container">
                <button class="location-button">
                    <i data-feather="map-pin"></i>
                    <span style="margin-left: 5px;">Change location</span>
                </button>
            </div>
        </div>
        <div style="position: fixed; bottom: 10%; left: 42.5%; font-weight: 600; color: #222831;">Developed by Samoel Andres</div>
    </div>
    <script src="public/script/script.js"></script>
</body>

</html>