# Nepali Currency Formater ( Basic )

# For getting formated currency in english 
```php
(new NepaliCurrencyFormatter\CurrencyFormatter())->formatToMoney(520250);
```
-- will output: 5,20,250

# For getting formated currency in nepali
```php
(new NepaliCurrencyFormatter\CurrencyFormatter())->formatToMoney(520250, ['is_unicode' => true]);
```
-- will output: ५,२०,२५०
