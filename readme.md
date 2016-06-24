# Three Toe: An SMS Autoresponder using the Twilio API

Author: [Colin Devroe](http://cdevroe.com)

Three Toe accepts a [Twilio](http://twilio.com) webhook POST and responds to the sender with the contents of a TXT file (based on the body of a sender's message) if found.

1. Sender TXTs Twilio powered phone number with "T0001"
2. Twilio sends webhook to Three Toe
3. Three Toe looks for "T0001.txt" in /responses
4. If found, responds. If not found, responds with nopropertyinfo.txt

This simple script was built to scratch an itch and learn the basics of the Twilio API. You can [read more about the backstory on my blog](http://cdevroe.com/).

## Installation

1. Copy entire app to server
2. Copy app/config-private-sample.php and create app/config-private.php
3. Fill in Twilio account information and phone numbers in your config-private.php
4. Create response TXT files in /responses (a few examples given)

(You'll need to set up a phone number on Twilio with a webbook that points to your URL.)

## Version History

### 0.1.0 - June 24, 2016
  - Initial app
  - Basic responses based on text file
  - Basic response if no code found
  - Readme
