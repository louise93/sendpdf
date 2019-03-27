<?php

Auth::routes();
Route::get('/', function(){

	return view('auth.login');
});

Route::get('/home', 'DashboardController@index')->name('home');

Route::post('user/login','AuthController@postLogin');

Route::post('send','RegistrationController@sendMail');

// //DASHBOARD
// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
// Route::get('/dashboard/balances', 'DashboardController@getWalletBalances');
// Route::get('/dashboard/incomes', 'DashboardController@getIncomes');
// Route::get('/dashboard/matchingpoints', 'DashboardController@getMatchingPoints');
// Route::get('/dashboard/downlines', 'DashboardController@getDownlines');
//
// //PROFILE section
// Route::get('/profile/personalinfo', 'ProfileController@index');
// Route::get('/profile/info', 'ProfileController@getProfile');
// Route::post('/profile/update', 'ProfileController@updateProfile');
// Route::get('/profile/bankinfo', 'ProfileController@getBankInfo');
// Route::post('/profile/bankupdate', 'ProfileController@updateBank');
// Route::get('/profile/btcaddress', 'ProfileController@getWallet');
// Route::post('/profile/walletupdate', 'ProfileController@updateWallet');
// Route::get('/profile/password', 'ProfileController@getPassword');
// Route::post('/profile/passwordupdate', 'ProfileController@updatePassword');
// Route::get('/profile/transactionpassword', 'ProfileController@getTransPassword');
// Route::post('/profile/transpasswordupdate', 'ProfileController@updateTransPassword');
//
// Route::get('/profile/kyc', 'ProfileController@kyc');
//
// Route::post('/profile/kyc/uploadphoto','ProfileController@fileUploadPhoto');
// Route::post('/profile/kyc/uploadid','ProfileController@fileUploadID');
// Route::post('/profile/kyc/uploadaddress','ProfileController@fileUploadAddress');
//
//
//
//
//
// //Announcment
//
// Route::get('/announcement', 'AnnouncementController@index');
// Route::get('/announcement/list', 'AnnouncementController@getAnnouncement');
// Route::get('/announcement/list/{n_id}', 'AnnouncementController@detail');
//
// // XINROX PACAGE
// Route::get('/packages', 'XinroxController@index');
//
// // GENEALOGY
// Route::get('/genealogy/directsponsor', 'GenealogyController@index');
// Route::post('/genealogy/directsponsor', 'GenealogyController@index');
//
// Route::get('/genealogy/downlines', 'GenealogyController@downlines');
// Route::post('/genealogy/downlines', 'GenealogyController@downlines');
//
// Route::get('/genealogy/sponsortree/', 'GenealogyController@sponsorTreeDefault');
// Route::get('/genealogy/sponsortree/{user_id}', 'GenealogyController@sponsorTree');
//
// Route::get('/genealogy/networktree', 'GenealogyController@binaryTreeDefault');
// Route::get('/genealogy/networktree/{user_id}', 'GenealogyController@binaryTreeSearch');
// Route::get('/genealogy/register/{pl_id}/{sponsor_id}/{position}', 'RegistrationController@register');
//
// Route::get('/genealogy/register','GenealogyController@getReg');
//
// //REGISTRATION
//
// Route::post('/genealogy/create','RegistrationController@postAccount');
// Route::get('/genealogy/registration','GenealogyController@registerView');
// Route::post('/genealogy/search','GenealogyController@searchSponsor');
// //affiliates
// Route::get('/affiliates','AffiliateController@index');
//
// //PORTFOLIO
// Route::get('/portfolio','PortfolioController@index');
// Route::get('/compounding','PortfolioController@compounding');
//
// //WALLET
// Route::get('/internaltransfer','WalletController@interTransfer');
// Route::post('/internaltransfer/transfer','WalletController@fundTransfer');
// Route::post('/internaltransfer/getBalance','WalletController@getBalance');
// Route::get('wallets/list','WalletController@index');
// Route::get('wallets/ewallet/transfer','WalletController@ewallet');
// Route::post('wallets/ewallet/transfer','WalletController@ewalletTransfer');
//
// Route::get('wallets/ewallet/withdraw','WalletController@ewalletwithdraw');
// Route::post('wallets/ewallet/withdraw','WalletController@ewalletwithdrawrequest');
// Route::get('wallets/rwallet','WalletController@rwallet');
// Route::post('wallets/rwallet/transfer','WalletController@rwalletTransfer');
// Route::get('wallets/forexwallet','WalletController@forexwallet');
// Route::post('wallets/forexwallet/transfer','WalletController@forexwalletTransfer');
// Route::get('wallets/virtualwallet','WalletController@virtualwallet');
// Route::post('wallets/virtualwallet/transfer','WalletController@virtualwalletTransfer');
//
// Route::get('wallets/history','WalletController@historyView');
// Route::post('wallets/history','WalletController@historyView');
//
// Route::get('withdrawals/open','WithdrawalController@openWithdrawals');
// Route::get('withdrawals/close','WithdrawalController@closeWithdrawals');
//
// Route::post('wallets/receiver','WalletController@getReceiver');
//
//
//
//
// Route::get('/externaltransfer','WalletController@externalTransfer');
// Route::get('/balances','WalletController@balances');
// Route::get('/withdrawals','WalletController@widthdrawals');
// Route::post('/withdrawals/withdraw','WalletController@withdrawNow');
// Route::post('/externaltransfer/transfer','WalletController@externalfundTransfer');
// Route::post('/externaltransfer/getReceiver','WalletController@getReceiver');
//
//
// //REPORTS
// Route::get('sponsorincome','ReportController@sponsorincome');
// Route::get('matchingincome','ReportController@matchingincome');
// Route::get('leadershipincome','ReportController@leadershipincome');
// Route::get('promotionalincome','ReportController@promotionalincome');
// Route::get('profitshareincome','ReportController@profitshareincome');
// Route::get('poolbonus','ReportController@poolbonus');
// Route::get('rewardpoints','ReportController@reward');
//
//
// Route::get('reports/incomes','ReportController@sponsorincome');
// Route::post('reports/search','ReportController@searchIncome');
//
// Route::get('reports/matchingpoints','ReportController@matchingpoints');
//
// Route::get('reports/fundtransfer','ReportController@transferHistory');
// Route::post('reports/fundtransfer/search','ReportController@searchHistory');
//
//
// //PRE REGISTRATION PORTAL
// Route::get('preregister','RegistrationController@freeRegView');
// Route::post('preregister/create','RegistrationController@freeRegistration');
// Route::get('preregister/activation','RegistrationController@activateView');
// Route::post('preregister/activate','RegistrationController@activate');
//
// Route::get('preregister/activationdownline/{downline_id}','RegistrationController@activationViewDownline');
// Route::post('preregister/activatedownline','RegistrationController@activateDownline');
// Route::get('reset/password','RegistrationController@resetPass');
// Route::post('reset/password','RegistrationController@updatePass');
// Route::get('reset/transpassword','RegistrationController@resetTransPass');
// Route::post('reset/transpassword','RegistrationController@updateTransPass');
// Route::get('preregister/{sponsor_id}/{position}','RegistrationController@freeRegView');
//
//
// Route::get('activation','RegistrationController@activationView');
//
//
// Route::post('login/user','LoginController@login');
//
//
// //TICKETS
//
// Route::get('support/tickets','TicketsController@index');
//
//
// Route::get('new_ticket', 'TicketsController@create');
// Route::post('new_ticket', 'TicketsController@store');
// Route::get('tickets/{ticket_id}', 'TicketsController@show');
// Route::get('my_tickets', 'TicketsController@userTickets');
// Route::post('comment', 'CommentsController@postComment');
//
//
//
// Route::get('contacts','ContactController@index');
// Route::get('contacts/list','ContactController@getDownlines');
// Route::post('contacts/getinfo','ContactController@getInfo');
// Route::post('contacts/searchdownline','ContactController@searchDownline');
//
// Route::get('tools','ProfileController@learning');
//
// Route::get('educational','ProfileController@educational');
//
//
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
// 	Route::get('tickets', 'TicketsController@index');
// 	Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
// 	Route::get('admin/dashboard','admin\DashboardController@index');
//
// });
// Route::get('chatroom','ChatroomController@index');
// // ADMIN ROUTES
//
// Route::get('admin/dashboard','admin\DashboardController@index');
//
// Route::get('generate/calendar','ProfitShareController@makeSchedule');
// Route::get('claim','ProfitShareController@claimProfit');
// Route::get('claim/today','ProfitShareController@claimTodayProfit');
//
// Route::get('claim/binary','ProfitShareController@matchingCommission');
//
// Route::get('admin/members/list','admin\UsersController@index');
// Route::post('admin/members/list','admin\UsersController@index');
// Route::post('admin/members/search','admin\UsersController@searchMember');
// Route::get('admin/members/genealogy','admin\UsersController@genealogy');
// Route::post('admin/members/genealogy/search','admin\UsersController@binaryTreeSearch');
// Route::get('admin/members/genealogy/{user_id}','admin\UsersController@binaryTreeSearchUser');
// Route::get('admin/members/downlines','admin\UsersController@downlines');
// Route::post('admin/members/downlines','admin\UsersController@downlines');
