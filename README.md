# Nepali Currency Formater

# For getting formated currency in english 
```php
   $obj = new CurrencyFormater();
   $obj->formatToMoney(520250);
```
-- will output: 5,20,250

# For getting formated currency in nepali
```php
   $obj = new CurrencyFormater();
   $obj->formatToMoney(520250, true);
```
-- will output: ५,२०,२५०
