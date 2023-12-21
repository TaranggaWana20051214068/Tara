// Manipulasi Array

//  1. Menambahkan isi array
// var arr = [];
// arr[0] = "tarangga";
// arr[1] = "wana";
// arr[2] = "GG";
// console.log(arr);

// 2.Menghapus isi array
// var arr = ["Tara", "Wana", "GG"];
// arr[1] = undefined;
// console.log(arr);

// 3. Menampilakan isi array
// var arr = ["Tara", "Wana", "GG", "rahmat", "ipul"];
// for (var i = 0; i < arr.length; i++) {
//   console.log("cowo paling ganteng ke-" + (i + 1) + ": " + arr[i]);
// }

// method pada array
// 1. join
// var arr = ["Tara", "Wana", "GG", "rahmat", "ipul"];

// console.log(arr.join());

// 2. push & pop
// arr.pop();
// arr.push("randy");
// console.log(arr.join(" - "));

// 3. unshift and shift
// arr.shift();
// arr.unshift("randy");
// console.log(arr.join(" - "));

//contoh menampilkan API
// const endpoint = "https://regres.in/api/users/3";

// fetch(endpoint)
//   .then((result) => result.json())
//   .then(({ data }) => console.log(data));

// async function hitAPI() {
//   const api = await fetch(endpoint);
//   const data = await api.json();
//   console.log(data);
// }

// hitAPI();

// contoh menambahkan data ke API
// fetch(endpoint, {
//   method: "POST",
//   body: JSON.stringify({
//     email: "aaaa@gmail.com",
//     firstName: "tara",
//   }),
// })
//   .then((result) => result.json())
//   .then(({ data }) => console.log(data));

// API URL
// const apiUrl =
//   "https://api.weatherapi.com/v1/timezone.json?key=88b00f6f3bc046cdb3a153709231309&q=Surabaya";

// // Function to fetch weather data and create cards
// function fetchWeatherData() {
//   fetch(apiUrl)
//     .then((response) => response.json())
//     .then((data) => {
//       // Extract the forecast data
//       const forecast = data.forecast.forecastday[0];

//       // Get the location
//       const location = data.location.name;

//       // Create a card with weather information
//       const card = document.createElement("div");
//       card.classList.add("card");
//       card.innerHTML = `
//                   <h2>Location: ${location}</h2>
//                   <h3>Date: ${forecast.date}</h3>
//                   <p>Condition: ${forecast.day.condition.text}</p>
//                   <p>Max Temperature: ${forecast.day.maxtemp_c}°C</p>
//                   <p>Min Temperature: ${forecast.day.mintemp_c}°C</p>
//                   <p>Humidity: ${forecast.day.avghumidity}%</p>
//               `;

//       // Add the card to the weather-cards div
//       const weatherCards = document.getElementById("weather-cards");
//       weatherCards.appendChild(card);
//     })
//     .catch((error) => {
//       console.error("Error fetching weather data:", error);
//     });
// }

// // Call the fetchWeatherData function to retrieve and display data
// fetchWeatherData();

//collabsible
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".collapsible");
  var instances = M.Collapsible.init(elems, options);
});
//sidenav
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".sidenav");
  var instances = M.Sidenav.init(elems, options);
});

// Inisialisasi dropdown
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".dropdown-button");
  var instances = M.Dropdown.init(elems);
});
