const puppeteer = require('puppeteer');

let scrape_button = document.getElementById('scrape_btn');

let scrape_message = document.getElementById('scraping_message');

let scraper_form = document.getElementById('scraper_form');
let interval_tracker = {val: 0}
let base_url = "http://127.0.0.1:8000";

let selector = document.getElementById('selector');
let web_url = document.getElementById('web_url');
let items = {val: ""}

scraper_form.addEventListener('submit', (e) =>{
    e.preventDefault()
});

scrape_button.addEventListener('click', () => {
    console.log(web_url.value, selector.value);
    if(web_url.value && selector.value){

        startDotTicker();
        getScrapeItems();


        if(items && items.length > 0){
            console.log(items);
            stopDotTicker(interval_tracker.val);
        }
    }
});

function startDotTicker()
{
    let dot_number = 1;
    interval_tracker.val = setInterval(() => {
        dotTicker(dot_number);
        if(dot_number >= 3){
            dot_number = 1;
        }
        else{
            dot_number++;
        }
    }, 1300);
}

function stopDotTicker(tracker)
{
    clearInterval(tracker);
}

function dotTicker(dot_number)
{
    let dots = '';

    switch(dot_number){
        case 1:
            dots = '.';
            break
        case 2:
            dots = '. .';
            break;
        case 3:
            dots = '. . .';
            break;
        default:
            dots = dots;
    }
    scrape_message.innerHTML = 'Scraping website. Please wait ' + dots;
}


function getScrapeItems()
{

    let form_data = {
        'selector': selector.value,
        'web_url': web_url.value
    }

    console.log(form_data);

    $.ajax({
        url: base_url+"/api/web-scraping/"+web_url.value+"/"+selector.value,
        type: "GET",
        headers: {
            "Accept": "application/json",
            // "Access-Control-Allow-Origin": "*",
            "Content-Type": "application/json"
        },

        crossDomain: true,
        // data: {web_url: web_url.value, selector: selector.value},

        success: function(response){
            console.log(response);
            items.val = response;
            console.log(items);
            if(items.val.length > 0){
                // window.location.href = base_url+"/data-exist/"+form_data.web_url+"/"+form_data.selector;
            }
        },

        error: function(){
            console.log('error');
        }

    });

}
