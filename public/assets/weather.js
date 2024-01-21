// weather.js
const apiKey = 'u7VZRYGrAxiQu81BN4hsCdzfAU1Z5uIF';
const cityKey = '224758'; // You'll need to obtain the city key from AccuWeather
const apiUrl = `https://dataservice.accuweather.com/currentconditions/v1/${cityKey}?apikey=${apiKey}`;

fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    // Process the weather data and update your banner
    const weatherBanner = document.getElementById('weather-banner');
    weatherBanner.innerHTML = `Current Weather: ${data[0].WeatherText}, Temperature: ${data[0].Temperature.Metric.Value}°C`;
  })
  .catch(error => console.error('Error fetching weather data:', error));

