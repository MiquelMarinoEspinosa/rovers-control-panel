Add to the /etc/hosts the rovers-control-panel.nasa.org. Sample of the first entry
	sudo vi /etc/hosts
	127.0.0.1	localhost rovers-control-panel.nasa.org	

Build de docker nginx and php-fpm containers
	docker-compose up

Install the composer dependencies
	docker exec -i -t nasa.php-fpm composer install

Execute the unit tests
	docker exec -i -t nasa.php-fpm vendor/bin/phpunit

Execute the unit tests with coverage
	docker exec -i -t nasa.php-fpm vendor/bin/phpunit --coverage-html coverage
	open coverage/index.html

Execute the behat acceptance tests
	docker exec -i -t nasa.php-fpm vendor/bin/behat

Execute the documentation sample as a CURL
	curl --request POST -d '{"plateau": "5 5", "roverSquad":[{"position": "1 2 N", "instructions":"LMLMLMLMM"}, {"position": "3 3 E", "instructions":"MMRMMRMRRM"}]}' -H "Content-Type: application/json"  https://rovers-control-panel.nasa.org/explore --insecure

Format json request sample
{
   "plateau":"5 5",
   "roverSquad":[  
      {  
         "position":"1 2 N",
         "instructions":"LMLMLMLMM"
      },
      {  
         "position":"3 3 E",
         "instructions":"MMRMMRMRRM"
      }
   ]
}

Format json response sample
{  
   "roverSquad":[  
      {  
         "position":"1 3 N"
      },
      {  
         "position":"5 1 E"
      }
   ]
}
