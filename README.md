# Call to client via Twilio API

Test by TrueCare24

## Details about task

### Task Deliverable

A demo in the form of a web page completed design + Twilio API

### Task Description

Based on the provided designs, make a responsive webpage + API
integration (you can use a trial testing Twilio account).

1. Front end of the providers list
2. Implement the call button:
    - When call icon is clicked, first Twilio calls the phone number #1 (Admin)
    - Once admin picked up the phone, the number #2 (provider) is called.
    - Both connected.
3. Thing creatively of the functionality and implement 
 
Mark the task appropriately. 

Designs you will find [here](https://drive.google.com/drive/folders/1pdZhXQHugTe7qwbuzzgAgBV_ek3lAEmb?usp=sharing).

## How to use

### Preparation

Clone the repo and change your work directory to root of sources

    git clone https://github.com/EvilFreelancer/truecare24-twilio.git
    cd truecare24-twilio

Now you need prepare docker compose config file:

    cp docker-compose.yml.dist docker-compose.yml

### Change parameters

| Env parameter       | Description |
|---------------------|-------------|
| TWILIO_ACCOUNT_SID  | Your personal ID of Twilio account |
| TWILIO_AUTH_TOKEN   | Authorization token |
| TWILIO_NUMBER       | Twilio phone number |
| TWILIO_NUMBER_ADMIN | Admin phone number |
| TWILIO_OUTBOUND_URL | Url for calling to user |

Inside `docker-compose.yml` you need change the values to the ones you
need, for example you do not want to tun this project on `80` port, to
fix that you need just change this line `80:80` to what you need (`7777:80`).

    docker-compose build
    docker-compose up -d

The shortest instruction out of all, I know, that's because everything
is already pre-configured via NPM and you just need run it.

### Now it works

Now you just need open following page http://localhost in your browser
and you will get the result of my work.

## How use Docker container

Build the image of container

    docker build . --tag tc24-twilio

Run container on `80` port, mount into container files from current
folder and mount apache logs to logs folder.

    docker run -v `pwd`/logs:/var/log/apache2 -v `pwd`:/app -p 80:80 test:latest
