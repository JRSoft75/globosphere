1. create fake data
   console doctrine:fixtures:load
   
2. create index in elasticsearch
   console fos:elastica:populate
   
3. run dev server
   server:start
   
4. http://127.0.0.1:8000/