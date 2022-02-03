<?php

namespace App\Http\Controllers;

use App\Models\Communes;
use App\Models\Customers;
use App\Models\Logs;
use App\Models\Regions;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //

    public function store(Request $request)
    {

        $type = "input";
        $ip = $request->ip();
        $this->createLog("Http request post customer", $request, $ip, $type);
        $token = $request->input('token');
        if ($this->findUserByToken($token, $ip)) {

            return $this->createcustomer(
                $request->input('dni'),
                $request->input('id_reg'),
                $request->input('id_com'),
                $request->input('email'),
                $request->input('name'),
                $request->input('last_name'),
                $request->input('address'),
                $request->input('date_reg'),
                $request->input('status'),
                $ip

            );
        } else {
            $this->createLog("Not authorized", "token->" . $token, $ip, "output");
            return response()->json([
                'response' => "false",

            ], 400);
        }

    }

    public function findUserByToken($token, $ip)
    {
        $now = date("YmdHis");
        $user = User::where('token', $token)->where('expire_at', '>', $now)->get()->take(1);
        $type = "output";

        if (count($user) > 0) {
            $this->createLog("User Found ", $user[0]->id, $ip, $type);
            return true;
        } else {
            $this->createLog("User Not Found ", "token-> " . $token, $ip, $type);
            return false;

        }
    }

    public function show(Request $request)
    {
        $ip = $request->ip();
        $this->createLog("Get Customers ", $request, $ip, "input");

        $token = $request->input('token');
        if ($this->findUserByToken($token, $ip)) {
            $dni = $request->input('dni');
            $email = $request->input('email');

            if (isset($dni) && isset($email)) {
                return $this->findByDniAndEmail($dni, $email, $ip);
            }

            if (isset($dni)) {
                return $this->findByDni($request->input('dni'), $ip);
            }

            if (isset($email)) {
                return $this->findByEmail($email, $ip);
            }
        } else {
            $this->createLog("Not authorized", "token->" . $token, $ip, "output");
            return response()->json([
                'response' => "false",

            ], 400);
        }
    }

    public function delete(Request $request)
    {
        $ip = $request->ip();
        $this->createLog("Http request delete customer", $request, $ip, "input");
        $token = $request->input('token');
        if ($this->findUserByToken($token, $ip)) {
            $dni = $request->input('dni');
            return $this->destroyByDni($dni, $ip);
        } else {
            $this->createLog("Not authorized", "token->" . $token, $ip, "output");
            return response()->json([
                'response' => "false",

            ], 400);
        }
    }

    private function createLog($action, $params, $ip, $type)
    {
        $isProd = env("IS_PROD");
        if (!$isProd) {
            $log = new Logs;
            $log->action = $action;
            $log->ip = $ip;
            $log->type = $type;
            $log->params = $params;
            $log->save();
        } else {
            if ($type === "input") {
                $log = new Logs;
                $log->action = $action;
                $log->ip = $ip;
                $log->type = $type;
                $log->params = $params;
                $log->save();
            }
        }

    }

    private function destroyByDni($dni, $ip)
    {
        $customer = Customers::findOrFail($dni);
        if ($customer->status === 'A' || $customer->status === 'I') {
            $customer->status = 'trash';
            $customer->save();
            $this->createLog("Customer Delete", $customer, $ip, "output");
            return response()->json([
                'response' => true,

            ], 200);
        } else {
            $this->createLog("Customer dont exist", "Dni->" . $dni, $ip, "output");
            return response()->json([
                'response' => "El Registro no existe",

            ], 404);
        }
    }

    private function findByDni($dni, $ip)
    {
        $customer = Customers::findOrFail($dni);
        if ($customer->status === 'A') {
            $commune = Customers::find($customer->dni)->communes;
            $region = Customers::find($customer->dni)->regions;
            $addressAux = null;
            if (isset($customer->address)) {
                $addressAux = $customer->address;
            }
            $this->createLog("Customer Found ", $customer, $ip, "output");
            return response()->json([
                'response' => true,
                'data' => ([
                    'name' => $customer->name,
                    'last_name' => $customer->last_name,
                    'address' => $addressAux,
                    'region' => $region->description,
                    "commune" => $commune->description,
                ]),

            ], 201);
        } else {
            $this->createLog("Customer not Found ", "Dni->" . $dni, $ip, "output");
            return response()->json([
                'response' => false,

            ], 404);
        }
    }

    private function findByEmail($email, $ip)
    {

        $customer = Customers::where('email', $email)->where('status', 'A')->get()->take(1);

        if (count($customer) > 0) {

            $commune = Customers::find($customer[0]->dni)->communes;
            $region = Customers::find($customer[0]->dni)->regions;
            $addressAux = null;
            if (isset($customer[0]->address)) {
                $addressAux = $customer[0]->address;
            }
            $this->createLog("Customer Found ", $customer[0], $ip, "output");
            return response()->json([
                'response' => true,

                'data' => [
                    'name' => $customer[0]->name,
                    'last_name' => $customer[0]->last_name,
                    'address' => $addressAux,
                    'region' => $region->description,
                    "commune" => $commune->description,

                ],

            ], 201);
        } else {
            $this->createLog("Customer not Found ", "Email->" . $email, $ip, "output");
            return response()->json([
                'response' => false,

            ], 404);
        }
    }

    private function findByDniAndEmail($dni, $email, $ip)
    {
        $customer = Customers::where('email', $email)->where('dni', $dni)->where('status', 'A')->get()->take(1);

        if (count($customer) > 0) {
            $commune = Customers::find($customer[0]->dni)->communes;
            $region = Customers::find($customer[0]->dni)->regions;
            $addressAux = null;
            if (isset($customer[0]->address)) {
                $addressAux = $customer[0]->address;
            }
            $this->createLog("Customer Found ", $customer[0], $ip, "output");
            return response()->json([
                'response' => true,

                'data' => [
                    'name' => $customer[0]->name,
                    'last_name' => $customer[0]->last_name,
                    'address' => $addressAux,
                    'region' => $region->description,
                    "commune" => $commune->description,

                ],

            ], 201);
        } else {
            $this->createLog("Customer not Found ", "Dni->" . $dni . "Email->" . $email, $ip, "output");
            return response()->json([
                'response' => false,

            ], 404);
        }

    }

    private function createcustomer($dni, $id_reg, $id_com, $email, $name, $last_name, $address, $date_reg, $status, $ip)
    {

        $region = Regions::findOrFail($id_reg);
        $commune = Communes::findOrFail($id_com);
        $customer = "";
        if ($commune->id_reg === $id_reg) {

            $customer = Customers::firstOrCreate([
                'dni' => $dni,
            ],
                [
                    'dni' => $dni,
                    'id_reg' => $id_reg,
                    'id_com' => $id_com,
                    'email' => $email,
                    'name' => $name,
                    'last_name' => $last_name,
                    'address' => $address,
                    'date_reg' => $date_reg,
                    'status' => $status,

                ]);

            $customer->save();

            $this->createLog("Customer saved ", $customer, $ip, "output");
            return response()->json([
                'response' => true,

            ], 201);
        } else {
            $this->createLog("Fail to save a Customer ", $customer, $ip, "output");

            return response()->json([
                'response' => false,

            ], 404);
        }
    }

}
