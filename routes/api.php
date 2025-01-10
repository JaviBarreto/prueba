<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BankAcountClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAddressController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleUserTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\ProductOfferController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProviderAddressController;
use App\Http\Controllers\ProviderBankController;
use App\Http\Controllers\RawMaterialInventoryController;
use App\Http\Controllers\RawMaterialTransferController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserTypeController;

// Route::get('/user', function (Request $request) {
//     $users = User::all();
//     return $users->toArray();
// })->middleware('auth:sanctum');

// Route::post('/registerUserr', function () {
//     return "welcome";
// });

// Route::post('/registerUser', [userConttoller::class, 'registerUser']);

// Route::post('/registerUser', function () {
//     return "welcome"; q
// });

/*********************************  INIT USER  *********************************************************************************/
Route::post('/createUser', [UserController::class, 'createUser']);
Route::get('/showUser/{id}', [UserController::class,'showUser']);
Route::get('/listUsers', [UserController::class,'listUsers']);
Route::get('/listarUsuarios', [UserController::class,'listarUsuarios']);
Route::put('/updateUser/{id}', [UserController::class,'updateUser']);
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/users', [UserController::class, 'users']);
Route::post('/logout',[UserController::class, 'logout']);
Route::post('/forgotPassword',[UserController::class, 'forgotPassword']);
Route::post('/changePassword',[UserController::class, 'changePassword']);
/*********************************  END USER  **********************************************************************************/

/*********************************  INIT MODULE  *******************************************************************************/
Route::post('/createModule', [ModuleController::class, 'createModule']);
Route::get('/showModule/{id}', [ModuleController::class, 'showModule']);
Route::get('/listModules', [ModuleController::class, 'listModules']);
Route::put('/updateModule/{id}', [ModuleController::class, 'updateModule']);
Route::delete('/deleteModule/{id}', [ModuleController::class, 'deleteModule']);
/*********************************  END MODULE  ********************************************************************************/

/*********************************  INIT MODULE USER TYPE  *********************************************************************/
Route::post('/createModuleUserType', [ModuleUserTypeController::class, 'createModuleUserType']);
Route::get('/showModuleUserType/{id}', [ModuleUserTypeController::class, 'showModuleUserType']);
Route::get('/listModuleUserTypes', [ModuleUserTypeController::class, 'listModuleUserTypes']);
Route::put('/updateModuleUserType/{id}', [ModuleUserTypeController::class, 'updateModuleUserType']);
Route::delete('/deleteModuleUserType/{id}', [ModuleUserTypeController::class, 'deleteModuleUserType']);
/*********************************  END MODULE USER TYPE  **********************************************************************/

/*********************************  INIT USER TYPE  ****************************************************************************/
Route::post('/createUserType', [UserTypeController::class, 'createUserType']);
Route::get('/showUserType/{id}', [UserTypeController::class, 'showUserType']);
Route::get('/listUserTypes', [UserTypeController::class, 'listUserTypes']);
Route::put('/updateUserType/{id}', [UserTypeController::class, 'updateUserType']);
Route::delete('/deleteUserType/{id}', [UserTypeController::class, 'deleteUserType']);
/*********************************  END USER TYPE  *****************************************************************************/
   
   
/*******************************************************************************************************************************/
/*******************************************************************************************************************************/
/*******************************************************************************************************************************/


// Route::middleware(['auth:sanctum'])->group(function () {

    /*********************************  INIT AUDIT LOG  ************************************************************************/
    Route::post('/createAuditLog', [AuditLogController::class, 'createAuditLog']);
    Route::get('/showAuditLog/{id}', [AuditLogController::class, 'showAuditLog']);
    Route::get('/listAuditLogs', [AuditLogController::class, 'listAuditLogs']);
    Route::put('/updateAuditLog/{id}', [AuditLogController::class, 'updateAuditLog']);
    Route::delete('/deleteAuditLog/{id}', [AuditLogController::class, 'deleteAuditLog']);
    /*********************************  END AUDIT LOG  *************************************************************************/

    /*********************************  INIT BANK ACCOUNT CLIENT  **************************************************************/
    Route::post('/createBankAcountClient', [BankAcountClientController::class, 'createBankAcountClient']);
    Route::get('/showBankAcountClient/{id}', [BankAcountClientController::class, 'showBankAcountClient']);
    Route::get('/listBankAcountClients', [BankAcountClientController::class, 'listBankAcountClients']);
    Route::put('/updateBankAcountClient/{id}', [BankAcountClientController::class, 'updateBankAcountClient']);
    Route::delete('/deleteBankAcountClient/{id}', [BankAcountClientController::class, 'deleteBankAcountClient']);
    /*********************************  END BANK ACCOUNT CLIENT  ***************************************************************/

    /*********************************  INIT CATEGORY  *************************************************************************/
    Route::post('/createCategory', [CategoryController::class, 'createCategory']);
    Route::get('/showCategory/{id}', [CategoryController::class, 'showCategory']);
    Route::get('/listCategories', [CategoryController::class, 'listCategories']);
    Route::put('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
    /*********************************  END CATEGORY  **************************************************************************/

    /*********************************  INIT CLIENT  ***************************************************************************/
    Route::post('/createClient', [ClientController::class, 'createClient']);
    Route::get('/showClient/{id}', [ClientController::class, 'showClient']);
    Route::get('/listClients', [ClientController::class, 'listClients']);
    Route::put('/updateClient/{id}', [ClientController::class, 'updateClient']);
    Route::delete('/deleteClient/{id}', [ClientController::class, 'deleteClient']);
    /*********************************  END CLIENT  ****************************************************************************/

    /*********************************  INIT CLIENT ADDRESS  *******************************************************************/
    Route::post('/createClientAddress', [ClientAddressController::class, 'createClientAddress']);
    Route::get('/showClientAddress/{id}', [ClientAddressController::class, 'showClientAddress']);
    Route::get('/listClientAddresses', [ClientAddressController::class, 'listClientAddresses']);
    Route::put('/updateClientAddress/{id}', [ClientAddressController::class, 'updateClientAddress']);
    Route::delete('/deleteClientAddress/{id}', [ClientAddressController::class, 'deleteClientAddress']);
    /*********************************  END CLIENT ADDRESS  ********************************************************************/

    /*********************************  INIT MODULE USER TYPE  *****************************************************************/
    Route::post('/createModuleUserType', [ModuleUserTypeController::class, 'createModuleUserType']);
    Route::get('/showModuleUserType/{id}', [ModuleUserTypeController::class, 'showModuleUserType']);
    Route::get('/listModuleUserTypes', [ModuleUserTypeController::class, 'listModuleUserTypes']);
    Route::put('/updateModuleUserType/{id}', [ModuleUserTypeController::class, 'updateModuleUserType']);
    Route::delete('/deleteModuleUserType/{id}', [ModuleUserTypeController::class, 'deleteModuleUserType']);
    /*********************************  END MODULE USER TYPE  ******************************************************************/

    /*********************************  INIT ORDER  ****************************************************************************/
    Route::post('/createOrder', [OrderController::class, 'createOrder']);
    Route::get('/showOrder/{id}', [OrderController::class, 'showOrder']);
    Route::get('/listOrders', [OrderController::class, 'listOrders']);
    Route::put('/updateOrder/{id}', [OrderController::class, 'updateOrder']);
    Route::delete('/deleteOrder/{id}', [OrderController::class, 'deleteOrder']);
    /*********************************  END ORDER  *****************************************************************************/

    /*********************************  INIT ORDER ITEM  ***********************************************************************/
    Route::post('/createOrderItem', [OrderItemController::class, 'createOrderItem']);
    Route::get('/showOrderItem/{id}', [OrderItemController::class, 'showOrderItem']);
    Route::get('/listOrderItems', [OrderItemController::class, 'listOrderItems']);
    Route::put('/updateOrderItem/{id}', [OrderItemController::class, 'updateOrderItem']);
    Route::delete('/deleteOrderItem/{id}', [OrderItemController::class, 'deleteOrderItem']);
    /*********************************  END ORDER ITEM  ************************************************************************/

    /*********************************  INIT PARAMETER  ************************************************************************/
    Route::post('/createParameter', [ParameterController::class, 'createParameter']);
    Route::get('/showParameter/{id}', [ParameterController::class, 'showParameter']);
    Route::get('/listParameters', [ParameterController::class, 'listParameters']);
    Route::put('/updateParameter/{id}', [ParameterController::class, 'updateParameter']);
    Route::delete('/deleteParameter/{id}', [ParameterController::class, 'deleteParameter']);
    /*********************************  END PARAMETER  *************************************************************************/

    /*********************************  INIT PAYMENT METHOD  *******************************************************************/
    Route::post('/createPaymentMethod', [PaymentMethodController::class, 'createPaymentMethod']);
    Route::get('/showPaymentMethod/{id}', [PaymentMethodController::class, 'showPaymentMethod']);
    Route::get('/listPaymentMethods', [PaymentMethodController::class, 'listPaymentMethods']);
    Route::put('/updatePaymentMethod/{id}', [PaymentMethodController::class, 'updatePaymentMethod']);
    Route::delete('/deletePaymentMethod/{id}', [PaymentMethodController::class, 'deletePaymentMethod']);
    /*********************************  END PAYMENT METHOD  ********************************************************************/

    /*********************************  INIT PRODUCT  **************************************************************************/
    Route::post('/createProduct', [ProductController::class, 'createProduct']);
    Route::get('/showProduct/{id}', [ProductController::class, 'showProduct']);
    Route::get('/listProducts', [ProductController::class, 'listProducts']);
    Route::put('/updateProduct/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
    /*********************************  END PRODUCT  ***************************************************************************/

    /*********************************  INIT PRODUCT INVENTORY  ****************************************************************/
    Route::post('/createProductInventory', [ProductInventoryController::class, 'createProductInventory']);
    Route::get('/showProductInventory/{id}', [ProductInventoryController::class, 'showProductInventory']);
    Route::get('/listProductInventories', [ProductInventoryController::class, 'listProductInventories']);
    Route::put('/updateProductInventory/{id}', [ProductInventoryController::class, 'updateProductInventory']);
    Route::delete('/deleteProductInventory/{id}', [ProductInventoryController::class, 'deleteProductInventory']);
    /*********************************  END PRODUCT INVENTORY  *****************************************************************/

    /*********************************  INIT PRODUCT OFFER  ********************************************************************/
    Route::post('/createProductOffer', [ProductOfferController::class, 'createProductOffer']);
    Route::get('/showProductOffer/{id}', [ProductOfferController::class, 'showProductOffer']);
    Route::get('/listProductOffers', [ProductOfferController::class, 'listProductOffers']);
    Route::put('/updateProductOffer/{id}', [ProductOfferController::class, 'updateProductOffer']);
    Route::delete('/deleteProductOffer/{id}', [ProductOfferController::class, 'deleteProductOffer']);
    /*********************************  END PRODUCT OFFER  *********************************************************************/

    /*********************************  INIT PROVIDER  *************************************************************************/
    Route::post('/createProvider', [ProviderController::class, 'createProvider']);
    Route::get('/showProvider/{id}', [ProviderController::class, 'showProvider']);
    Route::get('/listProviders', [ProviderController::class, 'listProviders']);
    Route::put('/updateProvider/{id}', [ProviderController::class, 'updateProvider']);
    Route::delete('/deleteProvider/{id}', [ProviderController::class, 'deleteProvider']);
    /*********************************  END PROVIDER  **************************************************************************/

    /*********************************  INIT PROVIDER ADDRESS  *****************************************************************/
    Route::post('/createProviderAddress', [ProviderAddressController::class, 'createProviderAddress']);
    Route::get('/showProviderAddress/{id}', [ProviderAddressController::class, 'showProviderAddress']);
    Route::get('/listProviderAddresses', [ProviderAddressController::class, 'listProviderAddresses']);
    Route::put('/updateProviderAddress/{id}', [ProviderAddressController::class, 'updateProviderAddress']);
    Route::delete('/deleteProviderAddress/{id}', [ProviderAddressController::class, 'deleteProviderAddress']);
    /*********************************  END PROVIDER ADDRESS  ******************************************************************/

    /*********************************  INIT PROVIDER BANK  ********************************************************************/
    Route::post('/createProviderBank', [ProviderBankController::class, 'createProviderBank']);
    Route::get('/showProviderBank/{id}', [ProviderBankController::class, 'showProviderBank']);
    Route::get('/listProviderBanks', [ProviderBankController::class, 'listProviderBanks']);
    Route::put('/updateProviderBank/{id}', [ProviderBankController::class, 'updateProviderBank']);
    Route::delete('/deleteProviderBank/{id}', [ProviderBankController::class, 'deleteProviderBank']);
    /*********************************  END PROVIDER BANK  *********************************************************************/

    /*********************************  INIT RAW MATERIAL INVENTORY  ***********************************************************/
    Route::post('/createRawMaterialInventory', [RawMaterialInventoryController::class, 'createRawMaterialInventory']);
    Route::get('/showRawMaterialInventory/{id}', [RawMaterialInventoryController::class, 'showRawMaterialInventory']);
    Route::get('/listRawMaterialInventories', [RawMaterialInventoryController::class, 'listRawMaterialInventories']);
    Route::put('/updateRawMaterialInventory/{id}', [RawMaterialInventoryController::class, 'updateRawMaterialInventory']);
    Route::delete('/deleteRawMaterialInventory/{id}', [RawMaterialInventoryController::class, 'deleteRawMaterialInventory']);
    /*********************************  END RAW MATERIAL INVENTORY  ************************************************************/

    /*********************************  INIT RAW MATERIAL TRANSFER  ************************************************************/
    Route::post('/createRawMaterialTransfer', [RawMaterialTransferController::class, 'createRawMaterialTransfer']);
    Route::get('/showRawMaterialTransfer/{id}', [RawMaterialTransferController::class, 'showRawMaterialTransfer']);
    Route::get('/listRawMaterialTransfers', [RawMaterialTransferController::class, 'listRawMaterialTransfers']);
    Route::put('/updateRawMaterialTransfer/{id}', [RawMaterialTransferController::class, 'updateRawMaterialTransfer']);
    Route::delete('/deleteRawMaterialTransfer/{id}', [RawMaterialTransferController::class, 'deleteRawMaterialTransfer']);
    /*********************************  END RAW MATERIAL TRANSFER  *************************************************************/

    /*********************************  INIT SALE  *****************************************************************************/
    Route::post('/createSale', [SaleController::class, 'createSale']);
    Route::get('/showSale/{id}', [SaleController::class, 'showSale']);
    Route::get('/listSales', [SaleController::class, 'listSales']);
    Route::put('/updateSale/{id}', [SaleController::class, 'updateSale']);
    Route::delete('/deleteSale/{id}', [SaleController::class, 'deleteSale']);
    /*********************************  END SALE  ******************************************************************************/

    /*********************************  INIT SALE ITEM  ************************************************************************/
    Route::post('/createSaleItem', [SaleItemController::class, 'createSaleItem']);
    Route::get('/showSaleItem/{id}', [SaleItemController::class, 'showSaleItem']);
    Route::get('/listSaleItems', [SaleItemController::class, 'listSaleItems']);
    Route::put('/updateSaleItem/{id}', [SaleItemController::class, 'updateSaleItem']);
    Route::delete('/deleteSaleItem/{id}', [SaleItemController::class, 'deleteSaleItem']);
    /*********************************  END SALE ITEM  *************************************************************************/

    /*********************************  INIT STORAGE  **************************************************************************/
    Route::post('/createStorage', [StorageController::class, 'createStorage']);
    Route::get('/showStorage/{id}', [StorageController::class, 'showStorage']);
    Route::get('/listStorages', [StorageController::class, 'listStorages']);
    Route::put('/updateStorage/{id}', [StorageController::class, 'updateStorage']);
    Route::delete('/deleteStorage/{id}', [StorageController::class, 'deleteStorage']);
    /*********************************  END STORAGE  ***************************************************************************/

    /*********************************  INIT TRANSFER  *************************************************************************/
    Route::post('/createTransfer', [TransferController::class, 'createTransfer']);
    Route::get('/showTransfer/{id}', [TransferController::class, 'showTransfer']);
    Route::get('/listTransfers', [TransferController::class, 'listTransfers']);
    Route::put('/updateTransfer/{id}', [TransferController::class, 'updateTransfer']);
    Route::delete('/deleteTransfer/{id}', [TransferController::class, 'deleteTransfer']);
    /*********************************  END TRANSFER  **************************************************************************/

    // Route::post('/tokens/create', function (Request $request) {
    //     $token = $request->user()->createToken($request->token_name);
    //     return ['token' => $token->plainTextToken];
    // });

// });
