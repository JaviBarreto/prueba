<?php

use Illuminate\Support\Facades\Route;
use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/a', function () {
    return "welcome";
});



Route::get('/aaa', function () {
    return "welcome";
});

Route::get('/loadUsers', function () {
    return view('loadUsers');
});

Route::get('/importar', function () {
    return view('loadUsers');
});

// Route::get('/listar', function () {
//     $usuarios = Usuario::first();
//     return view('loadUsers')->whit($usuarios);
// });
Route::get('/listar', [UserController::class, 'listar']);
// Route::post('/registerUser', [UserController::class, 'registerUser']);
// Route::get('/importar', [UserController::class, 'importar']);


// Route::get('/listarUsuario', [UserControllers::class, 'listarUsuario']);

Route::get('/listarUsuario', function () {
    return view('loadUsers');
});

Route::get('listarUsuraios', function () {

    // $usuarios = Usuario::all();
    
    //     foreach ($usuarios as $usuario) {
    //         $password = $usuario->pass;
    //         $hashedPassword = bcrypt($password);

    //         $usuario->pass = $hashedPassword;
    //         $usuario->save();
    //     } 
    

    //     return $usuarios;


// $chunkSize = 100; // Tamaño del bloque
// $totalUsuarios = Usuario::count();
// $totalChunks = ceil($totalUsuarios / $chunkSize);

// for ($i = 0; $i < $totalChunks; $i++) {
//     $offset = $i * $chunkSize;
//     $usuarios = Usuario::offset($offset)->limit($chunkSize)->get();

//     foreach ($usuarios as $usuario) {
//         $password = $usuario->pass;
//         $hashedPassword = bcrypt($password);

//         $usuario->pass = $hashedPassword;
//         $usuario->save();
//     }
// }

$chunkSize = 1; // Tamaño del bloque
$totalUsuarios = Usuario::count();
$totalChunks = ceil($totalUsuarios / $chunkSize);

     $usuarios = Usuario::offset(0)->limit(5)->get();
    //$usuarios = Usuario::offset(101)->limit(200)->get();
    // $usuarios = Usuario::offset(201)->limit(300)->get();
    // $usuarios = Usuario::offset(301)->limit(400)->get();
    // $usuarios = Usuario::offset(401)->limit(500)->get();
    // $usuarios = Usuario::offset(501)->limit(600)->get();
    // $usuarios = Usuario::offset(601)->limit(700)->get();
    // $usuarios = Usuario::offset(701)->limit(800)->get();
    // $usuarios = Usuario::offset(801)->limit(900)->get();
    // $usuarios = Usuario::offset(901)->limit(1000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();
    // $usuarios = Usuario::offset(001)->limit(000)->get();

    // $usuarios = Usuario::offset(0)->limit(1000)->get();
    // $usuarios = Usuario::offset(999)->limit(2000)->get();
    // $usuarios = Usuario::offset(1999)->limit(3000)->get();
    // $usuarios = Usuario::offset(2999)->limit(4000)->get();
    // $usuarios = Usuario::offset(3999)->limit(5000)->get();
    // $usuarios = Usuario::offset(4999)->limit(6000)->get();
    // $usuarios = Usuario::offset(5999)->limit(7000)->get();
    // $usuarios = Usuario::offset(6999)->limit(8000)->get();
    // $usuarios = Usuario::offset(7999)->limit(9000)->get();
    // $usuarios = Usuario::offset(8999)->limit(10000)->get();
    // $usuarios = Usuario::offset(9999)->limit(11000)->get();
    // $usuarios = Usuario::offset(10999)->limit(12000)->get();
    // $usuarios = Usuario::offset(11999)->limit(13000)->get();
    // $usuarios = Usuario::offset(12999)->limit(14000)->get();
    // $usuarios = Usuario::offset(13999)->limit(15000)->get();
    // $usuarios = Usuario::offset(14999)->limit(000)->get();

    foreach ($usuarios as $usuario) {
        $password = $usuario->pass;
        $clave= $usuario->pass;
        $hashedPassword = bcrypt($password);

        $usuario->pass = $hashedPassword;
        $usuario->migrado = 1;
        $usuario->clave = $clave;
        $usuario->save();
    }


return $usuarios;

});