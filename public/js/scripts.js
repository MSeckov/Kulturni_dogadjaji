/*!
* Start Bootstrap - Shop Homepage v5.0.4 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

//adding ..more in texts

document.querySelectorAll('.more').forEach(element => {
    let show = false;
    element.addEventListener('click',e => {
        if(!show){
            e.target.previousElementSibling.style.height = 'auto';
            show = true;
        }
        else{
            e.target.previousElementSibling.style.height = '6em';
            show = false;
        }
     })})

/**weather api */

     let tempSpan = document.getElementById('locat')
    fetch('http://api.openweathermap.org/data/2.5/weather?q=Belgrade&appid=0093f3f01d321161bd08afa2936bca11&units=metric')
    .then(response => response.json())
    .then(data =>  {
        tempSpan.innerHTML ='Belgrade ' + data.sys.country + ' ' + `<img src = http://openweathermap.org/img/wn/${data.weather[0].icon }.png width=30px height=30px>` + Math.round(data.main.temp) + ' \u2103' + ' ' + `&nbsp; <small>${data.weather[0].description}</small>`;
        //console.log(data)
    } );

    
