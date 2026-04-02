# RabbitMQ with CodeIgniter 4 (CI4)

This project demonstrates how to integrate RabbitMQ with CodeIgniter 4
using php-amqplib.


## Prerequisites

PHP >= 8.x

Composer

CodeIgniter 4 installed

## RabbitMQ installed and running

Install RabbitMQ
macOS (using Homebrew)
brew install rabbitmq
brew services start rabbitmq


## Ubuntu / Linux
sudo apt update \
sudo apt install rabbitmq-server \
sudo systemctl start rabbitmq-server \
sudo systemctl enable rabbitmq-server \


## RabbitMQ Web UI

http://localhost:15672/

Username: guest\
Password: guest

## Install

composer require php-amqplib/php-amqplib


## Project Structure

app/  \
├── Controllers/Home.php        → Send message \
├── Commands/RabbitConsumer.php → Receive message  \
├── Libraries/RabbitMQ.php      → RabbitMQ service \


## Code to Review

Controller: app/Controllers/Home.php 

Spark Command File: app/Commands/RabbitConsumer.php 

Library app/Libraries/RabbitMQ.php 


## Send Message

http://localhost:8080/rabbit/send

## Run Consumer

php spark rabbit:consume

## Example Output

Received: {"order_id":12345,"customer_name":"Zerin Arif"}\
Order ID: 12345\
Customer Name: Zerin Arif

## Author

ZERIN\
a.r.zerin@gmail.com\
https://www.arzerin.com
