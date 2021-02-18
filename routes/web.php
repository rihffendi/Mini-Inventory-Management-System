<?php



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home','HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard'], function(){
	Route::get('/', 'DashboardController@index')->name('dashboard.index');
});


Route::group(['prefix' => 'people'],function(){

	Route::group(['prefix' => 'suppliers'],function(){
		Route::get('/','SupplierController@index')->name('people.suppliers.index');
		Route::get('/create', 'SupplierController@create')->name('people.suppliers.create');
		Route::post('/store', 'SupplierController@store')->name('people.suppliers.store');
		Route::get('/{id}','SupplierController@show')->name('people.suppliers.show');
		Route::get('/edit/{id}','SupplierController@edit')->name('people.suppliers.edit');
		Route::post('/delete','SupplierController@destroy')->name('people.suppliers.delete');
		Route::post('/update/{id}','SupplierController@update')->name('people.suppliers.update');
	});
	Route::group(['prefix' => 'customers'],function(){
		Route::get('/','CustomerController@index')->name('people.customers.index');
		Route::get('/create', 'CustomerController@create')->name('people.customers.create');
		Route::post('/store', 'CustomerController@store')->name('people.customers.store');
		Route::get('/{id}','CustomerController@show')->name('people.customers.show');
		Route::get('/edit/{id}','CustomerController@edit')->name('people.customers.edit');
		Route::post('/delete','CustomerController@destroy')->name('people.customers.delete');
		Route::post('/update/{id}','CustomerController@update')->name('people.customers.update');
	});
	Route::group(['prefix' => 'employees'],function(){
		Route::get('/','EmployeeController@index')->name('people.employees.index');
		Route::get('/create', 'EmployeeController@create')->name('people.employees.create');
		Route::post('/store', 'EmployeeController@store')->name('people.employees.store');
		Route::get('/{id}','EmployeeController@show')->name('people.employees.show');
		Route::get('/edit/{id}','EmployeeController@edit')->name('people.employees.edit');
		Route::post('/delete','EmployeeController@destroy')->name('people.employees.delete');
		Route::post('/update/{id}','EmployeeController@update')->name('people.employees.update');
	});
	
});

Route::group(['prefix' => 'products'], function(){
	Route::get('/','ProductController@index')->name('products.index');
	Route::get('/create','ProductController@create')->name('products.create');
	Route::post('/fetch','ProductController@fetch')->name('products.fetch');
	Route::post('/store', 'ProductController@store')->name('products.store');
	Route::get('/{id}','ProductController@show')->name('products.show');
	Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
	Route::post('/update/{id}','ProductController@update')->name('products.update');
});


Route::group(['prefix' => 'purchases'], function(){
	Route::get('/','PurchaseController@index')->name('purchases.index');
	Route::get('/create','PurchaseController@create')->name('purchases.create');
	Route::post('/invcheck','PurchaseController@invcheck')->name('purchases.invcheck');
	Route::post('/fetch','PurchaseController@fetch')->name('purchases.fetch');
	Route::post('/singledata','PurchaseController@singledata')->name('purchases.singledata');
	Route::post('/store', 'PurchaseController@store')->name('purchases.store');
	Route::get('/{id}','PurchaseController@show')->name('purchases.show');
	Route::get('/edit/{id}','PurchaseController@edit')->name('purchases.edit');
	Route::post('/update/{id}','PurchaseController@update')->name('purchases.update');
	Route::get('/invoice/{id}','PurchaseController@invoice')->name('purchases.invoice');
	Route::get('/download/{id}','PurchaseController@download')->name('purchases.download');
});

Route::group(['prefix' => 'sales'], function(){
	Route::get('/','SaleController@index')->name('sales.index');
	Route::get('/create','SaleController@create')->name('sales.create');
	Route::post('/invcheck','SaleController@invcheck')->name('sales.invcheck');
	Route::post('/updatecheck','SaleController@updatecheck')->name('sales.updatecheck');
	Route::post('/fetch','SaleController@fetch')->name('sales.fetch');
	Route::post('/singledata','SaleController@singledata')->name('sales.singledata');
	Route::post('/store', 'SaleController@store')->name('sales.store');
	Route::get('/{id}','SaleController@show')->name('sales.show');
	Route::get('/edit/{id}','SaleController@edit')->name('sales.edit');
	Route::post('/update/{id}','SaleController@update')->name('sales.update');
	Route::get('/invoice/{id}','SaleController@invoice')->name('sales.invoice');
	Route::get('/download/{id}','SaleController@download')->name('sales.download');


});

Route::group(['prefix' => 'stock'],function(){
	Route::get('/','StockController@index')->name('stocks.index');
	Route::get('/edit/{id}','StockController@edit')->name('stocks.edit');

});

Route::group(['prefix' => 'category'], function(){
	Route::group(['prefix' => 'categories'], function(){
		Route::get('/','CategoryController@index')->name('category.categories.index');
		Route::get('/create','CategoryController@create')->name('category.categories.create');
		Route::post('/store', 'CategoryController@store')->name('category.categories.store');
		Route::get('/{id}','CategoryController@show')->name('category.categories.show');
		Route::get('/edit/{id}','CategoryController@edit')->name('category.categories.edit');
		Route::post('/update/{id}','CategoryController@update')->name('category.categories.update');
	});
	Route::group(['prefix' => 'sub-categories'], function(){
		Route::get('/','SubCategoryController@index')->name('category.sub-categories.index');
		Route::get('/create','SubCategoryController@create')->name('category.sub-categories.create');
		Route::post('/store', 'SubCategoryController@store')->name('category.sub-categories.store');
		Route::get('/{id}','SubCategoryController@show')->name('category.sub-categories.show');
		Route::get('/edit/{id}','SubCategoryController@edit')->name('category.sub-categories.edit');
		Route::post('/update/{id}','SubCategoryController@update')->name('category.sub-categories.update');
	});

});

Route::group(['prefix' => 'accounts'], function(){
	Route::group(['prefix' => 'incomes'], function(){
		Route::get('/','IncomeController@index')->name('accounts.incomes.index');
		Route::get('/create','IncomeController@create')->name('accounts.incomes.create');
		Route::post('/singledata','IncomeController@singledata')->name('accounts.incomes.singledata');
		Route::post('/store', 'IncomeController@store')->name('accounts.incomes.store');
		Route::get('/{id}','IncomeController@show')->name('accounts.incomes.show');
	});
	Route::group(['prefix' => 'expenses'], function(){
		Route::get('/','ExpenseController@index')->name('accounts.expenses.index');
		Route::get('/create','ExpenseController@create')->name('accounts.expenses.create');
		Route::post('/singledata','ExpenseController@singledata')->name('accounts.expenses.singledata');
		Route::post('/store', 'ExpenseController@store')->name('accounts.expenses.store');
		Route::get('/{id}','ExpenseController@show')->name('accounts.expenses.show');
	});

});


Route::group(['prefix' => 'reports'], function(){
	Route::group(['prefix' => 'purchases'], function(){
		Route::get('/','ReportPurchaseController@index')->name('reports.purchases.index');
		Route::post('/fetch','ReportPurchaseController@fetch')->name('reports.purchases.fetch');

	});
	Route::group(['prefix' => 'sales'], function(){
		Route::get('/','ReportSaleController@index')->name('reports.sales.index');
		Route::post('/fetch','ReportSaleController@fetch')->name('reports.sales.fetch');
	});
	Route::group(['prefix' => 'profitloss'], function(){
		Route::get('/','ReportPLController@index')->name('reports.profitloss.index');
		Route::post('/fetch','ReportPLController@fetch')->name('reports.profitloss.fetch');
	});

});


//Fallback
Route::fallback(function() {
    return redirect('/');
});