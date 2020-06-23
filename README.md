# Magento Plugin Installation Guide
#### Steps to intall Magento plugin

1.) Extract the zipped gateway plugin and you will find two folder in it named App and Skin.

2.) Paste the two folders into the root folder of magento.

3.) Log into magento admin panel and go to System=>Configuration=>Payment Methods and find the name of the plugin 
    and configure the plugin as provided by payment gateway and click to save.
    [Make sure that Cache Storage Management is disabled if not, go to System=>cache management,
    select all checkbox on left side and from Actions dropdown select disable on right side and click submit button.] 

4.) Now you can check the Payment Method on Magento Website [front end page] by adding product to cart.

5.) On checkout page you will see the payment gateway method.

6.) Now, you will be redirected to Payment Gateway Server and fill up the card details and billing address details.

7.) Now, click continue button to proceed and you will redirect back to merchant’s website.
