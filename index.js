const API_Key = `0cd246df5f8e2447e6f2c3cdcf5053f1`
const form = document.querySelector("form")
const search = document.querySelector("#search")
const weather = document.querySelector("#weather")

const getWeather = async (city) => {
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_Key}&units=metric`
    const response = await fetch(url);
    const data = await response.json()
    showWeather(data);
}

const showWeather = (data) => {
    document.getElementById('loc').innerHTML = `${data.name}`
    document.getElementById('temperature').innerHTML = `${data.main.temp}&deg;C`
    document.querySelector("#icon").src = `http://openweathermap.org/img/w/${data.weather[0].icon}.png`;
    document.getElementById("description").innerHTML = data.weather[0].description;
    document.querySelector(".wind").innerHTML =`Wind: ${data.wind.speed}km/hr`;
    document.querySelector(".humidity").innerHTML = `Humidity: ${data.main.humidity}%`;
    console.log(data);
}
function searchMe() {
    let city = document.getElementById("search").value;
    getWeather(city)
}
function time() {
    let time = new Date();
    let weekDays = [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday",
    ];
    let months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    document.querySelector(".month").innerHTML =
      weekDays[time.getDay() - 1] +
      ", " +
      months[time.getMonth()] +
      " " +
      time.getDate();
  }
  
  time();
getWeather('Liverpool');
