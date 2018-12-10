<?php
use App\User;
class ProductTest extends TestCase
{
   
    /**
     * /products [GET]
     */
    public function testShouldReturnAllProducts(){

        
        $user = User::first();       
        $response = $this->post('/auth/login', ['email' => $user->email, 'password' => '12345']);
        $token = json_decode($this->response->getContent())->token;
        //$this->refreshApplication();
        $this->get("products", ['Authorization' => 'Bearer ' .$token]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' =>  [
                '*' => [
                    'id',
                    'product_name',
                    'product_description'
                ]
            ],
            'links' => 
            [
                
                'first',
                'last',
                'prev',
                'next',                
            ],
            'meta' => 
            [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]            
        ]);        
    }
    
    /**
     * /products/id [GET]
     */
    public function testShouldReturnProduct(){

        $user = User::first();       
        $response = $this->post('/auth/login', ['email' => $user->email, 'password' => '12345']);
        $token = json_decode($this->response->getContent())->token;

        $this->get("products/2", ['Authorization' => 'Bearer ' .$token]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'id',
                    'product_name',
                    'product_description'
                ]
            ]    
        );
        
    }
    /**
     * /products [POST]
     */
    public function testShouldCreateProduct(){
        
        $user = User::first();       
        $response = $this->post('/auth/login', ['email' => $user->email, 'password' => '12345']);
        $token = json_decode($this->response->getContent())->token;

        $parameters = [
            'product_name' => 'Infinix',
            'product_description' => 'NOTE 4 5.7-Inch IPS LCD (3GB, 32GB ROM) Android 7.0 ',
        ];
        $this->post("products", $parameters, ['Authorization' => 'Bearer ' .$token]);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'id',
                    'product_name',
                    'product_description'
                ]
            ]    
        );
        
    }
    
    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct(){

        $user = User::first();       
        $response = $this->post('/auth/login', ['email' => $user->email, 'password' => '12345']);
        $token = json_decode($this->response->getContent())->token;
        
        $parameters = [
            'product_name' => 'Infinix Hot Note',
            'product_description' => 'Champagne Gold, 13M AF + 8M FF 4G Smartphone',
        ];

        $this->put("products/4", $parameters, ['Authorization' => 'Bearer ' .$token]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'id',
                    'product_name',
                    'product_description'
                ]
            ]    
        );
    }
    /**
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){
        
        $user = User::first();       
        $response = $this->post('/auth/login', ['email' => $user->email, 'password' => '12345']);
        $token = json_decode($this->response->getContent())->token;
        
        $this->delete("products/9", [], ['Authorization' => 'Bearer ' .$token]);
        $this->seeStatusCode(410);
        
    }
}