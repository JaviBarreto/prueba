<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
// use App\Http\Requests\PruebaDosRequest;
use App\Http\Requests\userRequests\PruebaDosRequest;
use App\Http\Requests\userRequests\CreateUserRequest;
use App\Http\Requests\userRequests\UpdateUserRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Models\Usuario;
use App\Models\UserSession;
use App\Services\UserService;
use App\Services\Utilities\PaginationValidationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\userRequests\PruebaDosRequest;
// use App\Http\Requests\userRequests\UpdateUserRequest;
// use App\Services\UserService;
// use App\Services\Utilities\PaginationValidationService;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Exception;

class UserController extends Controller
{
    protected $userService;
    protected $paginationValidationService;

    public function __construct(UserService $userService, PaginationValidationService $paginationValidationService)
    {
        $this->userService = $userService;
        $this->paginationValidationService = $paginationValidationService;
    }

    public function createUser(createUserRequest $request)
    {
        try {
            $data = $this->userService->createUser($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Record created successfully.',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $data = $this->userService->updateUser($request->validated(), $id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record updated successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteUser($id)
    {
        try {
            $data = $this->userService->deleteUser($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record deleted successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function showUser($id)
    {
        return 'sdf';
        try {
            $data = $this->userService->showUser($id);
            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function listUsers(Request $request)
    {
        try {
            $validationResult = $this->paginationValidationService->validatePagination($request->all());

            if (!$validationResult['success']) {
                return response()->json([
                    'success' => false,
                    'error' => $validationResult['error'],
                ], 400);
            }

            $perPage = $validationResult['perPage'];
            $page = $validationResult['page'];

            $data = $this->userService->listUser($perPage, $page);

            return $data ?
                response()->json([
                    'success' => true,
                    'message' => 'Record information retrieved successfully.',
                    'data' => $data
                ], 200) :
                response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Model not found',
                'detail' => $e->getMessage()
            ], 404);
        } catch (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Page not found.',
            ], 404);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(Exception $e)
    {
        return response()->json([
            'success' => false,
            'error' => [
                'message' => 'An error occurred while processing the request.',
                'detail' => $e->getMessage()
            ]
        ], 500);
    }
    



////////////////////////

public function users() {
    // return 'ss';
    // $expiration = config('sanctum.expiration');
    // return $expiration;
    $users = User::all();
    return $users->toArray();

}

public function importar() {
    $filePath = public_path('archivoUsers.xlsx');

    Excel::import(new UsersImport, $filePath);
    
    return redirect('/')->with('success', '¡Archivo importado con éxito!');
}

// public function listarUsuarios () {
    
//     $usuarios = Usuartio::first();
//     return $usuarios->pass;

// }

public function listar () {
    // $usuarios = Usuario::all();

    $chunkSize = 1; 
    $totalUsuarios = Usuario::count();
    $totalChunks = ceil($totalUsuarios / $chunkSize);
    $offset = Usuario::where('migrado','1')->count();

    if ($offset == 0){
        $offset = 0;
    }

    $usuariosHash = Usuario::offset($offset)->limit(1)->get();

    foreach ($usuariosHash as $usuario) {
        $password = $usuario->pass;
        $hashedPassword = bcrypt($password);

        $usuario->pass = $hashedPassword;
        $usuario->migrado = 1;
        $usuario->save();
    }

    $usuarios = Usuario::all();

    return view('loadUsers',['usuarios'=>$usuarios]);
}

public Function deleteUser1($id) {

    $user = User::find($id);
        
    $user->delete();

    try {
        return response()->json(['message' => 'Usuario eliminado correctamente.'], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'El usuario no se pudo encontrar.'], 404);
    }
}



public function restorePassword() {
    
    $user = User::create();
    $allUser = User::all();

}

public function login(Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    
    $user = User::where('email',  $request->email)->first();
    $userSession = new UserSession;
    
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['el correo proporcionado es incorrecto'],
        ]);
    }
    // return $user->id;
    $userSession->id_user = $user->id;
    $userSession->ip = $request->getClientIp();
    $userSession->save();
    // crear el registro que va a llevar el control de los inicios de sesion de cada usuario
    // $user = User::create([
    //     'id_user' => $request->name,
    //     'date_sesion' => $request->email,
    // ]);
    //retornar la ip y el dispositivo, si es pc o movil de la tabla de sesiones y de personal access tokens para que se envie al cliente
    //tanto la ip como la fecha de expiracion del token... habilitar los permisos que va a tener ese usuario relacionados con el campo habilities
    //revisar la tabla de seseions y sus atributos
    return $user->createToken('token')->plainTextToken;
}   

public function user(Request $request) {
    return $request->user();
}

public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully']);    
}

public function forgotPassword(Request $request) {
    //$userEmail = $request->input('email');
    $userEmail = 'javier.barreto@hotmail.com';
    
    Mail::send('forgotPassword', [], function ($message) use ($userEmail) {
        $message->to($userEmail)
        ->subject('Cambio de contraseña');
    });

    return "Correo electrónico de confirmación enviado correctamente";
}

public function changePassword(Request $request) {

    $request->validate([
        'newPassword' => 'required'
    ]);

    $user = $request->user();
    // $user->password =  Hash::make($request->password);
    $user->password = $request->newPassword;

    $user->save();

    return response()->json(['message'=>'cambiando clave',200]);
}

public function registerLogin() {
    return "registrando el inicio sesionm";
}
}