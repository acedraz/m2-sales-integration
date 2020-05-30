# SALES INTEGRATION - M2 #

Magento 2 module: Send to the API of an external system (ERP), the data of the orders that enter the virtual store

### Instalation ###

* Composer

Add in 'repositories' of composer.json (magento 2 project):

     "repositories": {
        "aislan-sales-integration": {
            "url": "https://github.com/acedraz/m2-sales-integration.git",
            "type": "git"
        }
     }

Make a require:

    composer require acedraz/m2-sales-integration:^1.0

* Manually
    
    Copy files to root/app/code/Aislan/SalesIntegration/
    
### IMPORTANT ###

Run this command in magento cli terminal (if necessary)

    php bin/magento module:enable Aislan_SalesIntegration
    php bin/magento setup:upgrade

### CONFIGURATIONS ###

This module requires some configurations:
    
* Enable: disable or enable module functionality
* API Url: ERP URI address
* API Key: token Bearer for API authentication
* ERP Endpoint: an ERP endpoint to post an order
* Reconnection Attempts: amount of reconnection if there is no favorable response from the API.

For configuration in magento admin painel:

    STORES -> CONFIGURATION -> AISLAN -> SALES INTEGRATION
    
### HOW TO TESTE ###
     
If you do not have an ERP system, you can test the sended order data in magento itself. A rest API call was created that responds to the endpoint:

    /webhook/sales
    
Using a terminal, you only need to run the command informing the order number (increment id):
    
    bin/magento sales:integration
    
Exemple: 

    bin/magento sales:integration 000000002

It will send a magento 000000002 (sample data installed) order to ERP endpoint following this structure:

    {
      "customer": {
        "name": "Veronica  Costello",
        "cpf_cnpj": "000.000.000-00",
        "telephone": "(555) 229-3326",
        "cnpj": "00.000.000/0000-00",
        "razao_social": "",
        "ie": "00000000",
        "dob": "14/12/1973",
        "nome_fantasia": ""
      },
      "shipping_address": {
        "street": "[\"6146 Honey Bluff Parkway\"]",
        "number": 0,
        "additional": "",
        "neighborhood": "Michigan",
        "city": "Calder",
        "city_ibge_code": 0,
        "uf": "",
        "country": "US"
      },
      "items": [
        {
          "sku": "WS08-XS-Blue",
          "name": "Minerva LumaTech&trade; V-Tee",
          "price": "32.0000",
          "qty": "1.0000"
        }
      ],
      "shipping_method": "Flat Rate - Fixed",
      "payment_method": "Flat Rate - Fixed",
      "payment_installments": 0,
      "subtotal": "32.0000",
      "shipping_amount": "5.0000",
      "discount": "0.0000",
      "total": "39.6400"
    }

If in the main administrator settings they are configured to use magento URI and /webhook/sales endpoint, this data can be recieved in PostOrderApiInterface::getOrderApi()
