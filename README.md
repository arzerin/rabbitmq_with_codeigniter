# RabbitMQ with CodeIgniter 4 (CI4)

This project demonstrates how to integrate RabbitMQ with CodeIgniter 4
using php-amqplib.

## RabbitMQ Web UI

http://localhost:15672/

Username: guest\
Password: guest

## Install

composer require php-amqplib/php-amqplib


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
