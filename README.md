# SALES INTEGRATION - M2 #

Magento 2 module: Movie Catalog Challenge

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
