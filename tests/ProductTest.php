<?php

class ProductTest extends TestCase
{

    /**
     * /products [GET]
     */
    public function testShouldReturnAllProducts(){
        $this->get("products", []);
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
        $this->get("products/2", []);
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
        $parameters = [
            'product_name' => 'Infinix',
            'product_description' => 'NOTE 4 5.7-Inch IPS LCD (3GB, 32GB ROM) Android 7.0 ',
        ];
        $this->post("products", $parameters, []);
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
        $parameters = [
            'product_name' => 'Infinix Hot Note',
            'product_description' => 'Champagne Gold, 13M AF + 8M FF 4G Smartphone',
        ];
        $this->put("products/4", $parameters, []);
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
        
        $this->delete("products/5", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
                'status',
                'message'
        ]);
    }
}