<?php
/**
 * Plugin Name: Delhi Weather Plugin
 * Description: Display the current weather in Delhi.
 * Version: 1.0
 * Author: Your Name
 */

// Enqueue the JavaScript file for weather data.
function enqueue_weather_script() {
    wp_enqueue_script('weather-script', plugins_url('weather-script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_weather_script');

// JavaScript for Weather Data
add_action('wp_footer', 'delhi_weather_script');
function delhi_weather_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var api_key = 'd53a2b92a4ed5fc4da3a52b9935d4aaf'; // Replace with your OpenWeatherMap API key
            var city = 'Delhi';
            var api_url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${api_key}&units=metric`;

            $.get(api_url, function(data) {
                var temperature = data.main.temp;
                var weatherDescription = data.weather[0].description;
                var weatherHtml = `<p>Temperature in Delhi: ${temperature}°C</p><p>Weather: ${weatherDescription}</p>`;
                $("#delhi-weather").html(weatherHtml);
            })
            .fail(function() {
                $("#delhi-weather").html("Failed to fetch weather data.");
            });
        });
    </script>
    <?php
}

// Display Weather Data in WordPress Pages
function display_delhi_weather() {
    echo '<div id="delhi-weather"><p>Loading...</p></div>';
}
add_shortcode('delhi_weather', 'display_delhi_weather');
?>
