const puppeteer = require('puppeteer');
const axios = require('axios');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('https://news.ycombinator.com', {
      waitUntil: 'networkidle2',
    });
    // Get the "viewport" of the page, as reported by the page.
    const elements = await page.$$('div');

    console.log('Elements:', elements);
    // items.val = elements;

    await axios.post()

    await browser.close();
  })();
