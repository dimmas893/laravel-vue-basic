<?php


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user', function () {
    $data = User::all();
    return response()->json(['data' => $data]);
});

Route::post('/user/post', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:5',
        'email' => 'required|max:15'
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
    } else {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            return response()->json(['status' => 200, 'message' => 'berhasil'], 200);
        } else {

            return response()->json(['status' => 500, 'message' => 'error'], 500);
        }
    }
});

Route::get('/user/{id}/edit', function ($id) {
    $data = User::where('id', $id)->first();
    if ($data) {
        return response()->json(['status' => 200, 'data' => $data], 200);
    } else {

        return response()->json(['status' => 404, 'message' => 'Id tidak ada'], 404);
    }
    // return response()->json();
});

Route::put('/user/{id}/update', function ($id, Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:5',
        'email' => 'required|max:15'
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
    } else {
        $userdata = User::where('id', $id)->first();

        if ($userdata) {
            $userdata->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return response()->json(['status' => 200, 'message' => 'berhasil'], 200);
        } else {

            return response()->json(['status' => 404, 'message' => 'ID user tidak ada'], 404);
        }
    }
});

Route::delete('/user/{id}/delete', function ($id) {
    $data = User::where('id', $id)->first();
    if ($data) {
        $data->delete();
        return response()->json(['status' => 200, 'message' => 'Berhasil Menghapus data'], 200);
    } else {

        return response()->json(['status' => 404, 'message' => 'Id tidak ada'], 404);
    }
});
